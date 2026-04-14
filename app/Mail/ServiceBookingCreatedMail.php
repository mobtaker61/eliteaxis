<?php

namespace App\Mail;

use App\Models\ServiceBooking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ServiceBookingCreatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ServiceBooking $booking
    ) {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Service Booking #'.$this->booking->id,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.service-booking-created',
        );
    }
}
