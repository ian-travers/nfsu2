<?php

namespace Tests\Feature\Backend\News;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admin_can_delete_a_news()
    {
        $this->signIn(User::factory()->admin()->create());

        $news = News::factory()->create();

        $this->assertDatabaseCount('news', 1);

        $this->delete("/adm/news/{$news->id}");

        $this->assertDatabaseCount('news', 0);
    }
}
