<?php

namespace App\Mail;

use App\Models\Pegawai;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotifPensiun extends Mailable
{
    use Queueable, SerializesModels;

    public $pegawai;
    /**
     * Create a new message instance.
     */
    public function __construct(Pegawai $pegawai)
    {
        $this->pegawai = $pegawai;
    }

    /**
     * Get the message envelope.
     */
     public function build()
    {
        return $this->subject('Pemberitahuan Pensiun')
        ->markdown('emails.Notifpensiun');
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