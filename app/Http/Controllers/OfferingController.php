<?php

namespace App\Http\Controllers;

use App\Mail\OfferingResultMail;
use App\Models\Applicants;
use App\Models\Offering;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OfferingController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $applicants = Applicants::with(['opportunity', 'interviewUser', 'offering.staff'])
            ->whereHas('interviewUser', fn($q) => $q->whereIn('decision_id', [2, 3]))
            ->when($search, fn($q, $search) => $q->where('fullname', 'like', '%' . $search . '%'))
            ->paginate(10);

        // Buat data Offering otomatis jika belum ada
        foreach ($applicants as $applicant) {
            Offering::firstOrCreate(
                ['applicant_id' => $applicant->id],
                [
                    'benefit' => '-',
                    'selection_result' => '-',
                    'deadline_offering' => now()->toDateString(),
                    'offering_result' => '-',
                    'staff_id' => Auth::id()
                ]
            );
        }

        return view('admin.offerings.index', compact('applicants', 'search'));
    }

    public function show($id)
    {
        $Offering = Offering::where('applicant_id', $id)->first();
        $applicant = Applicants::findOrFail($id);

        return view('admin.offerings.show', compact('Offering', 'applicant'));
    }

    public function edit($id)
    {
        $applicant = Applicants::findOrFail($id);
        $Offering = Offering::where('applicant_id', $id)->first();

        return view('admin.offerings.edit', compact('applicant', 'Offering'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'benefit' => 'required|string',
            'selection_result' => 'required|string',
            'deadline_offering' => 'required|date',
            'offering_result' => 'required|string',
        ]);

        // Cek nilai default
        if (
            trim($request->benefit) === '-' || trim($request->benefit) === '' ||
            trim($request->selection_result) === '-' || trim($request->selection_result) === '' ||
            trim($request->offering_result) === '-' || trim($request->offering_result) === ''
        ) {
            return redirect()->back()->with('error', 'Please change the default values of benefit, selection result, offering result before saving.');
        }

        // Ambil data Offering yang sudah ada
        $Offering = Offering::where('applicant_id', $id)->firstOrFail();

        // Update nilai pada Offering
        $Offering->benefit = $request->benefit;
        $Offering->selection_result = $request->selection_result;
        $Offering->deadline_offering = $request->deadline_offering;
        $Offering->offering_result = $request->offering_result;
        $Offering->staff_id = Auth::id();
        $Offering->save();

        return redirect()->route('admin.offerings.index')->with('success', 'Offering updated successfully.');
    }

    public function sendNotification($id)
    {
        $applicant = Applicants::with('offering')->findOrFail($id);
        $offering = $applicant->offering;

        // Cek kalau sudah dikirim, tolak pengiriman ulang
        if ($offering->notification_sent) {
            return redirect()->back()->with('error', 'Notification has already been sent.');
        }

        Mail::to($applicant->email)->send(new OfferingResultMail($applicant, $offering));

        // Tandai sudah dikirim
        $offering->notification_sent = true;
        $offering->save();

        return redirect()->back()->with('success', 'Notification sent successfully.');
}

}