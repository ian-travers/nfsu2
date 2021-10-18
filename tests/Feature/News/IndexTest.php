<?php

namespace Tests\Feature\News;

use App\Models\News;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /** @test */
    function everyone_can_view_news_list()
    {
        /** @var \App\Models\News $newsitem */
        $newsitem = News::factory()->create();

        // Set language explicitly because guest has no locale in the test
        $this->get('/news?lang=en')->assertSee($newsitem->title);
    }
}
