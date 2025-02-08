<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class CounterNotification extends Mailable
{
    use Queueable, SerializesModels;

    public string $unsubscribeToken;

    public function __construct(
        public int $count,
        public string $timestamp,
        public bool $marketing = false
    ) {
        $this->unsubscribeToken = Str::random(32);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🎯 Achievement Unlocked: Counter Milestone!',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.counter-notification',
        );
    }
}
