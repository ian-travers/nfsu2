<?php

namespace App\Notifications;

use App\Models\Competition\Competition;
use App\Models\NFSUServer\SpecificGameData;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class CompetitionWasCreated extends Notification
{
    use Queueable;

    private Competition $competition;

    public function __construct(Competition $competition)
    {
        $this->competition = $competition;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'ends_at' => $this->competition->ended_at->isoFormat('l'),
            'link' => 'competitions',
        ];
    }

    protected function getTrackName($trackId): string
    {
        return $trackId
            ? SpecificGameData::getTrackName($trackId)
            : '';
    }
}
