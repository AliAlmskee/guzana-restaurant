<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;

class UserEmail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $subject;
    public $body;
    public $order;

    public function __construct($subject, $body, Order $order = null)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->order = $order;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject, 
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.plain',
            with: [
                'body' => $this->body,
                'order' => $this->order,
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}