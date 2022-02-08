<?php

namespace Tests\Feature\News;

use App\Models\News;
use Tests\TestCase;

class ViewTest extends TestCase
{
    /** @test */
    function everyone_can_view_news_item()
    {
        /** @var \App\Models\News $newsitem */
        $newsitem = News::factory()->create();

        $this->get("/news/{$newsitem->slug}")
            ->assertSee($newsitem->title)
            ->assertSee($newsitem->body);
    }
}
