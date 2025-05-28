<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportingExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $applicants;

    public function __construct($applicants)
    {
        $this->applicants = $applicants;
    }

    public function collection()
    {
        return $this->applicants->map(function ($applicant) {
            return [
                'Name'             => $applicant->fullname ?? '-',
                'Opportunity'      => $applicant->opportunity->name ?? '-',
                'CV Screening'     => $applicant->screeningCv->decision->name ?? '-',
                'Psikotest'        => $applicant->psikotest->decision->name ?? '-',
                'Interview HR'     => $applicant->interviewHr->decision->name ?? '-',
                'Interview User'   => $applicant->interviewUser->decision->name ?? '-',
                'Offering'         => $applicant->offering->decision->name ?? '-',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Name',
            'Opportunity',
            'CV Screening',
            'Psikotest',
            'Interview HR',
            'User Interview',
            'Offering',
        ];
    }
}