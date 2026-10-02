<?php

namespace App\Mail;

use App\Models\VendorApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationApprovedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public VendorApplication $application) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: '✅ Your ELITE application has been APPROVED');
    }

    public function content(): Content
    {
        return new Content(view: 'emails.application-approved', with: ['application' => $this->application]);
    }
}
