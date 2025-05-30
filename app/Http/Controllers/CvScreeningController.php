<?php

namespace App\Http\Controllers;

use App\Mail\CvScreeningCustomInfoMail;
use App\Mail\CvScreeningResultMail;
use App\Models\Applicants;
use App\Models\CvScreening;
use App\Models\Decision;
use App\Models\InterviewHR;
use App\Models\InterviewUser;
use App\Models\Offering;
use App\Models\Psikotest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class CvScreeningController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // $cvScreening = CvScreening::all();

        $applicants = Applicants::with(['opportunity', 'cvScreening.decision', 'cvScreening.staff'])
            ->when($search, function ($query, $search) {
                return $query->where('fullname', 'like', '%' . $search . '%');
            })
            ->paginate(10);

        return view('admin.cv_screenings.index', compact('applicants', 'search'));
    }

    public function show($id)
    {
        $applicant = Applicants::with('cvScreening')->findOrFail($id);
        $cvScreening = $applicant->cvScreening;

        session()->flash('info', 'Viewing CV Screening details.');

        return view('admin.cv_screenings.show', compact('cvScreening', 'applicant'));
    }

    public function edit($id)
    {
        $applicant = Applicants::with('cvScreening')->findOrFail($id);
        // $cvScreening = CvScreening::where('applicant_id', $id)->first();
        $decisions = Decision::all();

        session()->flash('info', 'Edit the CV Screening information.');

        return view('admin.cv_screenings.edit', compact('applicant', 'decisions', 'cvScreening'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'score' => 'required|numeric|min:1|max:100',
            'decision_id' => 'required|exists:decisions,id',
            'notes' => 'required|string|min:5|max:1000'
        ]);

        // Validasi nilai default
        if (
            $request->score == 0 ||
            $request->notes === '-' ||
            trim($request->notes) === '' ||
            $request->decision_id == 1
        ) {
            return redirect()->back()->withInput()->with('error', 'Please fill in scores, notes, and select valid decisions before saving.');
        }

        $cvScreening = CvScreening::findOrFail($id);
        $cvScreening->score = $request->score;
        $cvScreening->decision_id = $request->decision_id;
        $cvScreening->notes = $request->notes;
        $cvScreening->staff_id = Auth::id();

        // Reset notifikasi jika ada perubahan keputusan ke 2, 3, atau 4
        if ($cvScreening->isDirty('decision_id') && in_array($cvScreening->decision_id, [2, 3, 4])) {
            $cvScreening->notification_sent = false;
        }

        $cvScreening->save();

        // Jika ditolak, hapus data lanjutan
        if ($cvScreening->decision_id == 4) {
            Psikotest::where('applicant_id', $cvScreening->applicant_id)->delete();
            InterviewHR::where('applicant_id', $cvScreening->applicant_id)->delete();
            InterviewUser::where('applicant_id', $cvScreening->applicant_id)->delete();
            Offering::where('applicant_id', $cvScreening->applicant_id)->delete();
        }

        return redirect()
            ->route('admin.cv_screenings.index')
            ->with('success', 'CV Screening updated successfully.');
    }

     // Mengirim notifikasi hasil CV Screening.
    public function sendNotification($id)
    {
        $applicant = Applicants::with('cvScreening.decision')->findOrFail($id);
        $cvScreening = $applicant->cvScreening;

        // Pastikan ada data cvScreening dan keputusan
        if (!$cvScreening || !$cvScreening->decision) {
            return redirect()->back()->with('error', 'CV Screening data is incomplete.');
        }

        // tidak dapat dikirimi notifikasi, harus diubah decision lain terlebih dahulu.
        if (!in_array($cvScreening->decision_id, [2, 3, 4])) {
            return redirect()->back()->with('error', 'Notifications have already been sent for this applicant and are final. Resubmissions are not permitted.');
        }

        // --- Logika Final Notifikasi ---
        // Jika notifikasi sudah pernah dikirim maka staff dapat mengirim email lagi, dengan syarat decision berbeda
        if ($cvScreening->notification_sent) {
            return redirect()->back()->with('error', 'Notifications have already been sent for this applicant.');
        }

        // Validasi skor dan catatan untuk keputusan "Disarankan", "Netral", dan "Tidak Disarankan"
        $score = trim($cvScreening->score);
        $notes = trim($cvScreening->notes);

        // --- Tentukan string hasil untuk email ---
        $emailResultString = '';
        if ($cvScreening->decision_id == 2 || $cvScreening->decision_id == 3) {
            $emailResultString = 'lolos';
        } elseif ($cvScreening->decision_id == 4) {
            $emailResultString = 'gagal';
        } else {
            // Ini seharusnya tidak tercapai karena sudah ada validasi di atas,
            // tapi sebagai fallback keamanan.
            $emailResultString = 'unknown';
        }

        try {
            // Kirim notifikasi email ke pelamar
            // Sekarang, kita meneruskan string 'lolos' atau 'gagal' ke Mailable
            Mail::to($applicant->email)->send(new CvScreeningResultMail($applicant, $emailResultString));

            $cvScreening->notification_sent = true;
            $cvScreening->save();

            return redirect()->back()->with('success', 'Notification sent successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to send email notification for applicant_id: ' . $applicant->id . ' - ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send notification. Please try again.');
        }
    }

    public function showCustomEmailForm($id)
    {
        $applicant = Applicants::findOrFail($id);
        $cvScreening = $applicant->cvScreening;

        if ($cvScreening->info_sent) {
            return redirect()->route('admin.cv_screenings.index')
                ->with('error', 'Additional information has already been sent for this applicant.');
        }

        return view('admin.cv_screenings.custom_email_form', compact('applicant'));
    }


    public function sendCustomEmail(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $applicant = Applicants::findOrFail($id);
        $cvScreening = $applicant->cvScreening;

        try {
            Mail::to($applicant->email)->send(new CvScreeningCustomInfoMail($applicant, $request->message));

            // Tandai info sudah dikirim
            $cvScreening->info_sent = true;
            $cvScreening->save();

            return redirect()->route('admin.cv_screenings.index')->with('success', 'Notification sent successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to send custom info email to applicant_id ' . $id . ' : ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send notification. Please try again.');
        }
    }


}