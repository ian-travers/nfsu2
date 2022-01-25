<?php

namespace App\Notifications;

use App\Models\Tourney\Tourney;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TourneyWasCreatedEmail extends Notification implements ShouldQueue
{
    use Queueable;

    protected Tourney $tourney;

    public function __construct(Tourney $tourney)
    {
        $this->tourney = $tourney;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Tourney was created')
            ->line("{$this->tourney->created_at->format('d.m.Y H:i')} new tourney was created")
            ->line("Name: {$this->tourney->name}")
            ->line("Track: {$this->tourney->trackName()}")
            ->action('View Tourney Details', url($this->tourney->frontendPath()));
    }
}
