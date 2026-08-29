<?php

namespace App\Mail;

use App\Models\Laporan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LaporanDiprosesNotification extends Mailable
{
    use Queueable, SerializesModels;

    public Laporan $laporan;

    public function __construct(Laporan $laporan)
    {
        $this->laporan = $laporan;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Anda Ditugaskan Menangani Laporan #' . $this->laporan->id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.laporan-diproses',
            with: [
                'laporan' => $this->laporan,
            ],
        );
    }
}
