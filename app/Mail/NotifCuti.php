<?php

namespace App\Mail;

use App\Models\PengajuanCuti;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifCuti extends Mailable
{
    use Queueable, SerializesModels;

    public $cuti;
    /**
     * Create a new message instance.
     */
    public function __construct(PengajuanCuti $cuti)
    {
        $this->cuti = $cuti;
    }

    /**
     * Get the message envelope.
     */
     public function build()
    {
        return $this->subject('Notifikasi Pengajuan Cuti')
        ->markdown('emails.NotifCuti');
        // ->view('cuti.cetak');
    }
    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Notif Cuti',
    //     );
    // }

    // /**
    //  * Get the message content definition.
    //  */
    // public function content(): Content
    // {
    //     return new Content(
    //         markdown: 'emails.NotifCuti',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
