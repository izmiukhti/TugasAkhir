<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Http\Request;
use App\Models\Reporting;
use App\Models\Applicants;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportingExport;

class ReportingController extends Controller
{
    public function index(Request $request)
{
    $id_opportunity = $request->input('id_opportunity');
    $opportunities = Opportunity::all();

    $applicants = Applicants::with([
        'opportunity',
        'cvScreening.decision',
        'psikotest.decision',
        'interviewHr.decision',
        'interviewUser.decision',
    ])
    ->when($id_opportunity, function ($query) use ($id_opportunity) {
        $query->where('id_opportunity', $id_opportunity);
    })
    ->paginate(5);

    return view('admin.reportings.index', compact('applicants', 'opportunities', 'id_opportunity'));
}


    public function export(Request $request)
    {
        // Ambil id_opportunity dari permintaan
        $id_opportunity = $request->input('id_opportunity');

        // Ambil data applicant berdasarkan id_opportunity jika ada,
        // Jika tidak ada, ambil semua applicants
        $query = Applicants::with([
            'cvScreening.decision',
            'psikotest.decision',
            'interviewHr.decision',
            'interviewUser.decision',
        ]);

        if ($id_opportunity) {
            $query->where('id_opportunity', $id_opportunity);
        }

        $applicants = $query->get();

        // Kembalikan data ke export, menggunakan model ReportingExport
        return Excel::download(new ReportingExport($applicants), 'reporting_filtered.xlsx');
    }
}