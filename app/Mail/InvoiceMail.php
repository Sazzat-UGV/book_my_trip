<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order_details;

    public function __construct($order_details)
    {
        $this->order_details=$order_details;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking Complete',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'frontend.pages.email.invoice',
            with: [
                'orderName' => $this->order_details->name,
                'orderAddress' => $this->order_details->address,
                'orderPhone' => $this->order_details->phone,
                'orderEmail' => $this->order_details->email,
                'orderCreate' => $this->order_details->created_at,
                'orderPrice' => $this->order_details->amount,
                'orderPackageName' => $this->order_details->booking_package_name,
                'orderBookingFrom' => $this->order_details->booking_from,
                'orderBookingTo' => $this->order_details->booking_to,
                'orderPackageType' => $this->order_details->booking_package_type,
                'orderPackageMember' => $this->order_details->member,
            ],

        );
    }

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
