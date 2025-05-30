<?php

namespace App\Http\Controllers;

use App\Mail\PsikotestCustomInfoMail;
use App\Mail\PsikotestResultMail;
use App\Models\Applicants;
use App\Models\Decision;
use App\Models\InterviewHR;
use App\Models\InterviewUser;
use App\Models\Offering;
use App\Models\Psikotest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PsikotestController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');

        $applicants = Applicants::with(['opportunity', 'cvScreening', 'psikotest.staff'])
            ->whereHas('cvScreening', fn($q) => $q->whereIn('decision_id', [2, 3]))
            ->when($search, fn($q, $search) => $q->where('fullname', 'like', '%' . $search . '%'))
            ->paginate(10);

        // Buat data psikotest otomatis jika belum ada
        foreach ($applicants as $applicant) {
            Psikotest::firstOrCreate(
    ['applicant_id' => $applicant->id],
        [
                'score' => 0,
                'decision_id' => 1, // Default decision_id
                'notes' => '-',
                'notification_sent' => false,
                'info_sent' => false,
                'staff_id' => Auth::id()
                ]
            );
        }

        return view('admin.psikotests.index', compact('applicants', 'search'));
    }

    public function show($id)
    {
        $psikotest = Psikotest::where('applicant_id', $id)->first();
        $applicant = Applicants::findOrFail($id);

        return view('admin.psikotests.show', compact('psikotest', 'applicant'));
    }

    public function edit($id)
    {
        $applicant = Applicants::findOrFail($id);
        $psikotest = Psikotest::where('applicant_id', $id)->first();
        $decisions = Decision::all();

        return view('admin.psikotests.edit', compact('applicant', 'psikotest', 'decisions'));
    }

    public function update(Request $request, $id)
    {
        // Validating the request data
        $request->validate([
            'score' => 'required|numeric|min:1|max:100',
            'decision_id' => 'required|exists:decisions,id',
            'notes' => 'required|string|min:5|max:1000'
        ]);

        // Cek nilai default
        if (
            $request->score == 0 ||
            $request->decision_id == 1 ||
            trim($request->notes) === '-' || trim($request->notes) === ''
        ) {
            return redirect()->back()->with('error', 'Please change the default values of score, decision, notes before saving.');
        }

        // Fetching the existing psikotest data for the given applicant
        $psikotest = Psikotest::where('applicant_id', $id)->firstOrFail();

        // Updating the psikotest record with the new values from the request
        $psikotest->score = $request->score;
        $psikotest->decision_id = $request->decision_id;
        $psikotest->notes = $request->notes;
        $psikotest->staff_id = Auth::id();

        // status notifikasi di-reset agar HRD bisa mengirim ulang.
        if ($psikotest->isDirty('decision_id') && in_array($psikotest->decision_id, [2, 3, 4])) {
            $psikotest->notification_sent = false;
        }

        $psikotest->save();

        // Hapus data lanjutan jika keputusan adalah 4 (tidak disarankan)
        if ($psikotest->decision_id == 4) {
            InterviewHR::where('applicant_id', $psikotest->applicant_id)->delete();
            InterviewUser::where('applicant_id', $psikotest->applicant_id)->delete();
            Offering::where('applicant_id', $psikotest->applicant_id)->delete();
        }

        return redirect()->route('admin.psikotests.index')->with('success', 'Psikotest updated successfully.');
    }

    public function sendNotification($id)
    {
        $applicant = Applicants::with('psikotest.decision')->findOrFail($id);
        $psikotest = $applicant->psikotest;

        // Pastikan ada data psikotest dan keputusannya
        if (!$psikotest || !$psikotest->decision) {
            return redirect()->back()->with('error', 'Psychotest data is incomplete.');
        }

        // Hanya ID 2, 3, 4 yang boleh kirim notifikasi
        if (!in_array($psikotest->decision_id, [2, 3, 4])) {
            return redirect()->back()->with('error', 'This decision cannot be notified.');
        }

        // Cek jika notifikasi sudah pernah dikirim untuk keputusan saat ini
        if ($psikotest->notification_sent) {
            return redirect()->back()->with('error', 'Notifications have already been sent for this decision.');
        }

        // Validasi skor dan catatan untuk keputusan "Disarankan", "Netral", dan "Tidak Disarankan"
        $score = trim($psikotest->score);
        $notes = trim($psikotest->notes);

        // --- Tentukan string hasil untuk email ---
        $emailResultString = '';
        if ($psikotest->decision_id == 2 || $psikotest->decision_id == 3) {
            $emailResultString = 'lolos';
        } elseif ($psikotest->decision_id == 4) {
            $emailResultString = 'gagal';
        } else {
            // Ini seharusnya tidak tercapai karena sudah ada validasi di atas,
            // tapi sebagai fallback keamanan.
            $emailResultString = 'unknown';
        }

        try {
            // Kirim notifikasi email ke pelamar
            // Asumsi PsikotestResultMail menerima objek $applicant dan $psikotest
            Mail::to($applicant->email)->send(new PsikotestResultMail($applicant, $emailResultString));

            // Tandai notifikasi sudah terkirim
            $psikotest->notification_sent = true;
            $psikotest->save();

            return redirect()->back()->with('success', 'Notification sent successfully.');

        } catch (\Exception $e) {
            Log::error('Failed to send email notification for applicant_id: ' . $applicant->id . ' - ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send notification. Please try again.');
        }
    }

    public function showCustomEmailForm($id)
    {
        $applicant = Applicants::findOrFail($id);
        $psikotest = $applicant->psikotest;

        if ($psikotest->info_sent) {
            return redirect()->route('admin.psikotests.index')
                ->with('error', 'Additional information has already been sent for this applicant.');
        }

        return view('admin.psikotests.custom_email_form', compact('applicant'));
    }

    public function sendCustomEmail(Request $request, $id)
{
    $request->validate([
        'message' => 'required|string|max:1000',
    ]);

    $applicant = Applicants::findOrFail($id);
    $psikotest = $applicant->psikotest;

    try {
        Mail::to($applicant->email)->send(new PsikotestCustomInfoMail($applicant, $request->message));

        // Tandai info sudah dikirim
        $psikotest->info_sent = true;
        $psikotest->save();

        return redirect()->route('admin.psikotests.index')->with('success', 'Notification sent successfully.');
    } catch (\Exception $e) {
        Log::error('Failed to send custom info email to applicant_id ' . $id . ' : ' . $e->getMessage());
        return redirect()->back()->with('error', 'Failed to send notification. Please try again.');
    }
}


}