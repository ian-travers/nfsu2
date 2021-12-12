<?php

namespace Tests\Feature\News;

use App\Models\News;
use Tests\TestCase;

class IndexTest extends TestCase
{
    /** @test */
    function everyone_can_view_news_list()
    {
        News::factory()->create([
            'title_en' => 'A title of the fake',
            'status' => 1, // it means published
        ]);

        // Set language explicitly because guest has no locale in the test
        $this->get('/news?lang=en')->assertSee('A title of the fake');
    }
}
