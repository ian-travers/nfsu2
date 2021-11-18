<?php

namespace App\Notifications;

use App\Models\Tourney\Tourney;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class TourneyWasCreated extends Notification
{
    use Queueable;

    protected Tourney $tourney;

    public function __construct(Tourney $tourney)
    {
        $this->tourney = $tourney;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'supervisor' => $this->tourney->supervisor_username,
            'action' => 'created',
            'title' => $this->tourney->name,
            'when' => $this->tourney->started_at,
            'at' => $this->tourney->trackName(),
            'link' => $this->tourney->frontendPath(),
        ];
    }
}
