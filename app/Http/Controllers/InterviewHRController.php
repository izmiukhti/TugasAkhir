<?php

namespace App\Http\Controllers;

use App\Mail\InterviewHRCustomInfoMail;
use App\Mail\InterviewHRResultMail;
use App\Models\Applicants;
use App\Models\Decision;
use App\Models\InterviewHR;
use App\Models\InterviewUser;
use App\Models\Offering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class InterviewHRController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $applicants = Applicants::with(['opportunity', 'psikotest', 'interviewHR.staff'])
            ->whereHas('psikotest', fn($q) => $q->whereIn('decision_id', [2, 3]))
            ->when($search, fn($q, $search) => $q->where('fullname', 'like', '%' . $search . '%'))
            ->paginate(10);


        // dd('applicants');

        // Buat data InterviewHR otomatis jika belum ada
        foreach ($applicants as $applicant) {
            InterviewHR::firstOrCreate(
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

        return view('admin.interview_hr.index', compact('applicants', 'search'));
    }

    public function show($id)
    {
        $interviewHR = InterviewHR::where('applicant_id', $id)->first();
        $applicant = Applicants::findOrFail($id);

        return view('admin.interview_hr.show', compact('interviewHR', 'applicant'));
    }

    public function edit($id)
    {
        $applicant = Applicants::findOrFail($id);
        $interviewHR = InterviewHR::where('applicant_id', $id)->first();
        $decisions = Decision::all();

        return view('admin.interview_hr.edit', compact('applicant', 'interviewHR', 'decisions'));
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

        // Ambil data InterviewHR yang sudah ada
        $interviewHR = InterviewHR::where('applicant_id', $id)->firstOrFail();

        // Update nilai pada InterviewHR
        $interviewHR->score = $request->score;
        $interviewHR->decision_id = $request->decision_id;
        $interviewHR->notes = $request->notes;
        $interviewHR->event_date = $request->event_date;
        $interviewHR->location = $request->location;
        $interviewHR->staff_id = Auth::id();

        // status notifikasi di-reset agar HRD bisa mengirim ulang.
        if ($interviewHR->isDirty('decision_id') && in_array($interviewHR->decision_id, [2, 3, 4])) {
            $interviewHR->notification_sent = false;
        }

        $interviewHR->save();

        if ($interviewHR->decision_id == 4) {
        // Deleting the related interview and offering records
        InterviewUser::where('applicant_id', $interviewHR->applicant_id)->delete();
        Offering::where('applicant_id', $interviewHR->applicant_id)->delete();
    }

        return redirect()->route('admin.interview_hr.index')->with('success', 'Interview HR updated successfully.');
    }

    public function sendNotification($id)
    {
        $applicant = Applicants::with('InterviewHR.decision')->findOrFail($id);
        $interviewHR = $applicant->interviewHR;

        // Pastikan ada data interview hr dan keputusannya
        if (!$interviewHR || !$interviewHR->decision) {
            return redirect()->back()->with('error', 'HR interview data is incomplete.');
        }

        // Hanya ID 2, 3 dan 4 yang boleh kirim notifikasi
        if (!in_array($interviewHR->decision_id, [2, 3, 4])) {
            return redirect()->back()->with('error', 'This decision cannot be notified.');
        }

        // Cek jika notifikasi sudah pernah dikirim untuk keputusan saat ini
        if ($interviewHR->notification_sent) {
            return redirect()->back()->with('error', 'Notifications have already been sent for this decision.');
        }

        // Validasi skor dan catatan untuk keputusan "Disarankan", "Netral", dan "Tidak Disarankan"
        $score = trim($interviewHR->score);
        $notes = trim($interviewHR->notes);
        $location = trim($interviewHR->location);

        // --- Tentukan string hasil untuk email ---
        $emailResultString = '';
        if ($interviewHR->decision_id == 2 || $interviewHR->decision_id == 3) {
            $emailResultString = 'lolos';
        } elseif ($interviewHR->decision_id == 4) {
            $emailResultString = 'gagal';
        } else {
            // Ini seharusnya tidak tercapai karena sudah ada validasi di atas,
            // tapi sebagai fallback keamanan.
            $emailResultString = 'unknown';
        }

        try {
            // Kirim notifikasi email ke pelamar
            // Asumsi InterviewHRResultMail menerima objek $applicant dan $interviewHR
            Mail::to($applicant->email)->send(new InterviewHRResultMail($applicant, $emailResultString));

            // Tandai notifikasi sudah terkirim
            $interviewHR->notification_sent = true;
            $interviewHR->save();

            return redirect()->back()->with('success', 'Notification sent successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to send email notification for applicant_id: ' . $applicant->id . ' - ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send notification. Please try again.');
        }
    }

    public function showCustomEmailForm($id)
    {
        $applicant = Applicants::findOrFail($id);
        $interviewHR = $applicant->interviewHR;

        if ($interviewHR->info_sent) {
            return redirect()->route('admin.interview_hr.index')
                ->with('error', 'Additional information has already been sent for this applicant.');
        }

        return view('admin.interview_hr.custom_email_form', compact('applicant'));
    }

    public function sendCustomEmail(Request $request, $id)
{
    $request->validate([
        'message' => 'required|string|max:1000',
    ]);

    $applicant = Applicants::findOrFail($id);
    $interviewHR = $applicant->interviewHR;

    try {
        Mail::to($applicant->email)->send(new InterviewHRCustomInfoMail($applicant, $request->message));

        // Tandai info sudah dikirim
        $interviewHR->info_sent = true;
        $interviewHR->save();

        return redirect()->route('admin.interview_hr.index')->with('success', 'Notification sent successfully.');
    } catch (\Exception $e) {
        Log::error('Failed to send custom info email to applicant_id ' . $id . ' : ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to send notification. Please try again.');
    }
}

}