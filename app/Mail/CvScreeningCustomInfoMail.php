<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Applicants;

class CvScreeningCustomInfoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $applicant;
    public $messageContent;

    public function __construct(Applicants $applicant, string $messageContent)
    {
        $this->applicant = $applicant;
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->subject('Informasi Tambahan dari HRD')
            ->view('admin.emails.custom_info'); // Buat blade view ini
    }
}