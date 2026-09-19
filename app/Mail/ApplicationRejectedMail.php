<?php

namespace App\Mail;

use App\Models\VendorApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationRejectedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public VendorApplication $application) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Your ELITE application update');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.application-rejected', with: ['application' => $this->application]);
    }
}