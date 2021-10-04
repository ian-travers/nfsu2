<?php

namespace App\Listeners\User;

use App\Models\News;
use Illuminate\Auth\Events\Registered;

class CreateNewsItemWhenRegistered
{
    public function handle(Registered $event)
    {
        $attributes = [
            'title_en' => 'Welcome new player',
            'title_ru' => 'Приветствуем нового игрока',
            'body_en' => "Our number has replenished. Let's warmly welcome player {$event->user->username}. Good luck with the races.",
            'body_ru' => "Наши ряды пополнились. Давайте тепло, как мы умеем, поприветствуем нового игрока {$event->user->username}. И удачи в гонках.",
            'status' => 1,
        ];

        News::create($attributes);
    }
}
