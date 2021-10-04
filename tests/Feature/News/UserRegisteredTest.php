<?php

namespace Tests\Feature\News;

use App\Http\Livewire\Auth\Register;
use App\Models\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class UserRegisteredTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function when_a_user_registered_related_news_item_is_created()
    {
        Livewire::test(Register::class)
            ->set('username', 'jonny')
            ->set('country', 'BY')
            ->set('email', 'john@example.com')
            ->set('password', '12345678')
            ->call('submit');

        $this->assertDatabaseCount('news', 1);

        $newsItem = News::find(1);

        $this->assertStringContainsString('jonny', $newsItem->body_en);
        $this->assertStringContainsString('jonny', $newsItem->body_ru);
    }
}
