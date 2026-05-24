<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

use App\Models\Peminjaman;

class StatusPeminjamanMail extends Mailable
{
    use Queueable, SerializesModels;

    public Peminjaman $peminjaman;

    /**
     * Create a new message instance.
     */
    public function __construct(Peminjaman $peminjaman)
    {
        $this->peminjaman = $peminjaman;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $status = ucfirst($this->peminjaman->status);
        return new Envelope(
            subject: "[{$status}] Status Pengajuan Peminjaman Barang - Karang Taruna",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.status-peminjaman',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
