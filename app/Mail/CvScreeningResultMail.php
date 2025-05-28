<?php

namespace App\Mail;

use App\Models\Applicants;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CvScreeningResultMail extends Mailable
{
    use Queueable, SerializesModels;

    public $applicant;
    public $result;

    public function __construct(Applicants $applicant, string $result)
    {
        $this->applicant = $applicant;
        $this->result = $result;
    }

    public function build()
    {
        return $this->subject('Hasil CV Screening')
            ->view('admin.emails.cv_screening_result');
    }
}