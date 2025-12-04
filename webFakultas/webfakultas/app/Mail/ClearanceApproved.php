<?php

namespace App\Mail;

use App\Models\Clearance;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClearanceApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $clearance;
    public $pdfContent; // Variabel untuk menyimpan data PDF

    public function __construct(Clearance $clearance, $pdfContent)
    {
        $this->clearance = $clearance;
        $this->pdfContent = $pdfContent;
    }

    public function build()
    {
        return $this->subject('✅ SURAT TERBIT: Bebas Tanggungan Fakultas')
                    ->view('emails.clearance_approved') // View Body Email (pake yang lama saja)
                    ->attachData($this->pdfContent, 'Surat_Bebas_Tanggungan.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}