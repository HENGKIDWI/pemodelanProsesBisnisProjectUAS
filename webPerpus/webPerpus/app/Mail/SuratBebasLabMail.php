<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // Opsional jika pakai antrian
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class SuratBebasLabMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    protected $pdfOutput;

    /**
     * Menerima data User dan Raw Data PDF dari Controller/Resource
     */
    public function __construct($user, $pdfOutput)
    {
        $this->user = $user;
        $this->pdfOutput = $pdfOutput;
    }

    /**
     * Mengatur Subjek Email
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Surat Bebas Tanggungan Perpustakaan',
        );
    }

    /**
     * Mengatur Isi Body Email
     * Pastikan view 'emails.surat-bebas' dibuat setelah ini
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.surat-bebas', 
        );
    }

    /**
     * Melampirkan File PDF
     */
    public function attachments(): array
    {
        return [
            Attachment::fromData(fn () => $this->pdfOutput, 'Surat_Bebas_perpus.pdf')
                ->withMime('application/pdf'),
        ];
    }
}