<?php

namespace Tests\Feature\Backend\News;

use App\Models\User;
use Tests\TestCase;

class CreateTest extends TestCase
{
    /** @test */
    function admin_can_create_a_news()
    {
        $this->signIn(User::factory()->admin()->create());

        $this->post('/adm/news', [
            'title_en' => 'First news',
            'title_ru' => 'Первая новость',
            'slug' => 'slug',
            'body_en' => 'First news content goes here',
            'body_ru' => 'Текст первой новости',
            'status' => 1,
        ]);

        $this->assertDatabaseCount('news', 1);
    }
}
