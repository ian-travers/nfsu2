<?php

namespace Tests\Feature\News;

use App\Models\Competition\Competition;
use Tests\TestCase;

class CompetitionCreatedTest extends TestCase
{
    /** @test */
    function when_a_competition_created_related_news_item_is_created_too()
    {
        Competition::factory()->create();

        $this->assertDatabaseCount('news', 1);
        $this->assertDatabaseHas('news', ['title_en' => "New competition is available"]);
    }
}
