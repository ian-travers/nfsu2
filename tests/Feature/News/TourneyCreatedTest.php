<?php

namespace Tests\Feature\News;

use App\Models\User;
use Carbon\Carbon;
use Tests\TestCase;

class TourneyCreatedTest extends TestCase
{
    /** @test */
    function when_a_tourney_created_related_news_item_is_created_too()
    {
        $this->withoutExceptionHandling();
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);

        $attributes = [
            'name' => 'Drag on Mine',
            'track_id' => '12020',
            'room' => 'tourney',
            'started_at' => Carbon::now()->addDays(2),
            'signup_time' => '15',
            'description' => 'It is fun.',
        ];

        $this->post('/cabinet/tourneys', $attributes);

        $this->assertDatabaseCount('news', 1);
        $this->assertDatabaseHas('news', ['title_en' => 'New tourney was scheduled']);
    }
}
