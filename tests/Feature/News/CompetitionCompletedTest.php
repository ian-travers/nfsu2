<?php

namespace Tests\Feature\News;

use App\Http\Livewire\Competition\Complete;
use App\Models\Competition\Competition;
use App\Models\User;
use Livewire\Livewire;
use Tests\TestCase;

class CompetitionCompletedTest extends TestCase
{
    /** @test */
    function when_a_competition_completed_related_news_item_is_created()
    {
        /** @var Competition $competition */
        $competition = Competition::factory()->create();

        $this->assertDatabaseCount('news', 1);

        $this->signIn(User::factory()->admin()->create());

        Livewire::test(Complete::class)
            ->set('competition', $competition)
            ->call('handle');

        $this->assertDatabaseCount('news', 2);
        $this->assertDatabaseHas('news', ['title_en' => "Current competition has been completed"]);
    }
}
