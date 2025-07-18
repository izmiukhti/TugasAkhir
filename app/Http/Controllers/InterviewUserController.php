<?php

namespace App\Http\Controllers;

use App\Mail\InterviewHRCustomInfoMail;
use App\Mail\InterviewUserResultMail;
use App\Models\Applicants;
use App\Models\Decision;
use App\Models\InterviewUser;
use App\Models\Offering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class InterviewUserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $applicants = Applicants::with(['opportunity', 'interviewHr', 'interviewUser.staff'])
            ->whereHas('interviewHr', fn($q) => $q->whereIn('decision_id', [2, 3]))
            ->when($search, fn($q, $search) => $q->where('fullname', 'like', '%' . $search . '%'))
            ->paginate(10);

        // Buat data InterviewUser otomatis jika belum ada
        foreach ($applicants as $applicant) {
            InterviewUser::firstOrCreate(
                ['applicant_id' => $applicant->id],
                [
                    'score' => 0,
                    'decision_id' => 1, // Default decision_id
                    'notes' => '-',
                    'event_date' => now(), // Menambahkan nilai untuk event_date
                    'location' => '-',
                    'notification_sent' => false,
                    'info_sent' => false,
                    'staff_id' => Auth::id()
                ]
            );
        }

        return view('admin.interview_user.index', compact('applicants', 'search'));
    }

    public function show($id)
    {
        $interviewUser = InterviewUser::where('applicant_id', $id)->first();
        $applicant = Applicants::findOrFail($id);

        return view('admin.interview_user.show', compact('interviewUser', 'applicant'));
    }

    public function edit($id)
    {
        $applicant = Applicants::findOrFail($id);
        $interviewUser = InterviewUser::where('applicant_id', $id)->first();

        $decisions = Decision::all();

        return view('admin.interview_user.edit', compact('applicant', 'interviewUser', 'decisions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'score' => 'required|numeric|min:1|max:100',
            'decision_id' => 'required|exists:decisions,id',
            'notes' => 'required|string|min:5|max:1000',
            'event_date' => 'required|date',
            'location' => 'required|string'
        ]);

        // Cek nilai default
        if (
            $request->score == 0 ||
            $request->decision_id == 1 ||
            trim($request->notes) === '-' || trim($request->notes) === '' ||
            trim($request->location) === '-' || trim($request->location) === ''
        ) {
            return redirect()->back()->with('error', 'Please change the default values of score, decision, notes, location before saving.');
        }

        // Ambil data InterviewUser yang sudah ada
        $interviewUser = InterviewUser::where('applicant_id', $id)->firstOrFail();

        // Update nilai pada InterviewUser
        $interviewUser->score = $request->score;
        $interviewUser->decision_id = $request->decision_id;
        $interviewUser->notes = $request->notes;
        $interviewUser->event_date = $request->event_date;
        $interviewUser->location = $request->location;

        // status notifikasi di-reset agar HRD bisa mengirim ulang.
        if ($interviewUser->isDirty('decision_id') && in_array($interviewUser->decision_id, [2, 3, 4])) {
            $interviewUser->notification_sent = false;
        }

        $interviewUser->staff_id = Auth::id();
        $interviewUser->save();

        if ($interviewUser->decision_id == 4) {
        // Deleting the related interview and offering records
        Offering::where('applicant_id', $interviewUser->applicant_id)->delete();
    }

        return redirect()->route('admin.interview_user.index')->with('success', 'Interview User updated successfully.');
    }

    public function sendNotification($id)
    {
        $applicant = Applicants::with('interviewUser.decision')->findOrFail($id);
        $interviewUser = $applicant->interviewUser;

        // Pastikan ada data interview user dan keputusannya
        if (!$interviewUser || !$interviewUser->decision) {
            return redirect()->back()->with('error', 'User interview data is incomplete.');
        }

        // Hanya ID 2, 3, 4 yang boleh kirim notifikasi
        if (!in_array($interviewUser->decision_id, [2, 3, 4])) {
            return redirect()->back()->with('error', 'This decision cannot be notified.');
        }

        // Cek jika notifikasi sudah pernah dikirim untuk keputusan saat ini
        if ($interviewUser->notification_sent) {
            return redirect()->back()->with('error', 'Notifications have already been sent for this decision.');
        }

        // Validasi skor dan catatan untuk keputusan "Disarankan", "Netral", dan "Tidak Disarankan"
        $score = trim($interviewUser->score);
        $notes = trim($interviewUser->notes);
        $location = trim($interviewUser->location);

        // --- Tentukan string hasil untuk email ---
        $emailResultString = '';
        if ($interviewUser->decision_id == 2 || $interviewUser->decision_id == 3) {
            $emailResultString = 'lolos';
        } elseif ($interviewUser->decision_id == 4) {
            $emailResultString = 'gagal';
        } else {
            // Ini seharusnya tidak tercapai karena sudah ada validasi di atas,
            // tapi sebagai fallback keamanan.
            $emailResultString = 'unknown';
        }

        try {
            // Kirim notifikasi email ke pelamar
            // Asumsi InterviewUserResultMail menerima objek $applicant dan $interviewUser
            Mail::to($applicant->email)->send(new InterviewUserResultMail($applicant, $emailResultString));

            // Tandai notifikasi sudah terkirim
            $interviewUser->notification_sent = true;
            $interviewUser->info_sent = false;
            $interviewUser->save();

            return redirect()->back()->with('success', 'Notification sent successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to send email notification for applicant_id: ' . $applicant->id . ' - ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send notification. Please try again.');
        }
    }

    public function showCustomEmailForm($id)
    {
        $applicant = Applicants::findOrFail($id);
        $interviewUser = $applicant->interviewUser;

        if ($interviewUser->info_sent) {
            return redirect()->route('admin.interview_user.index')
                ->with('error', 'Additional information has already been sent for this applicant.');
        }

        return view('admin.interview_user.custom_email_form', compact('applicant'));
    }

    public function sendCustomEmail(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $applicant = Applicants::findOrFail($id);
        $interviewUser = $applicant->interviewUser;

        // Hanya bisa kirim advance info setelah notifikasi dikirim
        if (!$interviewUser->notification_sent) {
            return redirect()->back()->with('error', 'Please send the initial notification first.');
        }

        if ($interviewUser->info_sent) {
            return redirect()->back()->with('error', 'Advance info has already been sent.');
        }

        try {
            Mail::to($applicant->email)->send(new InterviewHRCustomInfoMail($applicant, $request->message));

            // Tandai info sudah dikirim
            $interviewUser->info_sent = true;
            $interviewUser->save();

            return redirect()->route('admin.interview_user.index')->with('success', 'Notification sent successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to send custom info email to applicant_id ' . $id . ' : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send notification. Please try again.');
        }
    }

}