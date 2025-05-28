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

        $applicants = Applicants::with(['opportunity', 'interviewUser'])
            ->whereHas('interviewUser', function ($query) {
                $query->whereIn('decision_id', [2, 3]);
            })
            ->when($search, function ($query, $search) {
                return $query->where('fullname', 'like', '%' . $search . '%');
            })
            ->get();

        // Buat data Offering otomatis jika belum ada
        foreach ($applicants as $applicant) {
            Offering::firstOrCreate(
                ['applicant_id' => $applicant->id],
                [
                    'benefit' => '-',
                    'selection_result' => '-',
                    'deadline_offering' => now()->toDateString(),
                    'offering_result' => '-'
                ]
            );
        }

        // Ambil data applicant dengan paginasi setelah data Offering dibuat
        $applicants = Applicants::with(['opportunity', 'interviewUser', 'Offering.staff'])
            ->whereHas('interviewUser', function ($query) {
                $query->whereIn('decision_id', [2, 3]);
            })
            ->when($search, function ($query, $search) {
                return $query->where('fullname', 'like', '%' . $search . '%');
            })
            ->paginate(10);

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
            'benefit' => 'nullable|string',
            'selection_result' => 'nullable|string',
            'deadline_offering' => 'nullable|date',
            'offering_result' => 'nullable|string'

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
        $applicant = Applicants::with('Offering')->findOrFail($id);
        $Offering = $applicant->Offering;

        // Anggap semua data offering valid, maka dianggap "lolos"
        $result = 'lolos';

        Mail::to($applicant->email)->send(new OfferingResultMail($applicant, $Offering));

        return redirect()->back()->with('success', 'Notification sent successfully.');
    }
}