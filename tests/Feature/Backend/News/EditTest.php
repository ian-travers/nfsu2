<?php

namespace Tests\Feature\Backend\News;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EditTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admin_can_update_a_news()
    {
        $this->signIn(User::factory()->admin()->create());
        $this->withoutExceptionHandling();
        $news = News::factory()->create();

        $attributes =  [
            'title_en' => 'First news',
            'title_ru' => 'Первая новость',
            'body_en' => 'First news content goes here',
            'body_ru' => 'Текст первой новости',
            'status' => 1,
        ];

        $this->patch("/adm/news/{$news->id}", $attributes);

        $this->assertDatabaseCount('News', 1);
        $this->assertDatabaseHas('News', $attributes);
    }
}
