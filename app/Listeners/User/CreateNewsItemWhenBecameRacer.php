<?php

namespace App\Listeners\User;

use App\Events\BecomeRacer;
use App\Models\News;

class CreateNewsItemWhenBecameRacer
{
    public function handle(BecomeRacer $event)
    {
        $user = $event->user;

        $attributes = [
            'title_en' => "{$user->username} has been passed racer test",
            'title_ru' => "{$user->username} прошел тест гонщика",
            'body_en' => "Congratulations for {$user->username}. He just got racer status. Now he may fully participate in tourneys.",
            'body_ru' => "Поздравления для {$user->username}. Он только что получил статус гонщика и может теперь подавать заявки и принимать участие в турнирах.",
            'status' => 1,
        ];

        News::create($attributes);
    }
}
