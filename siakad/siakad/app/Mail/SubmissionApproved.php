<?php

namespace App\Mail;

use App\Models\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubmissionApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $submission;

    // Terima data submission saat class ini dipanggil
    public function __construct(Submission $submission)
    {
        $this->submission = $submission;
    }

    public function build()
    {
        return $this->subject('Status Pengajuan Cuti Studi - Disetujui')
                    ->view('emails.submission_approved'); // Kita akan buat view ini di langkah 3
    }
}