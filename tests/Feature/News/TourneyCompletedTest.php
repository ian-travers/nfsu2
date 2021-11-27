<?php

namespace Tests\Feature\News;

use App\Http\Livewire\TourneyHandle\Complete;
use App\Models\Tourney\Tourney;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class TourneyCompletedTest extends TestCase
{
    /** @test */
    function when_a_tourney_completed_related_news_item_is_created()
    {
        $this->withoutExceptionHandling();
        /** @var User $racer */
        $racer = User::factory()->racer()->create();

        $this->signIn($racer);

        /** @var Tourney $tourney */
        $tourney = Tourney::factory()->create([
            'supervisor_id' => $racer->id,
            'name' => 'Test tourney',
            'status' => Tourney::STATUS_FINAL,
        ]);

        Livewire::test(Complete::class)
            ->set('tourney', $tourney)
            ->call('handle')
            ->assertSessionHas('flash', [
                'type' => 'success',
                'message' => 'Tourney has been completed.',
            ]);

        $this->assertDatabaseCount('news', 1);
        $this->assertDatabaseHas('news', ['title_en' => "{$tourney->name} has been completed"]);
    }
}
