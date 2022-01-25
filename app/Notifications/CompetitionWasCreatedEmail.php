<?php

namespace App\Notifications;

use App\Models\Competition\Competition;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CompetitionWasCreatedEmail extends Notification implements ShouldQueue
{
    use Queueable;

    protected Competition $competition;

    public function __construct(Competition $competition)
    {
        $this->competition = $competition;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New competition was created.')
            ->action('View Competition Details', url('/competitions'));
    }
}
