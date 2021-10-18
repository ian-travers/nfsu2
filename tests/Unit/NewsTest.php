<?php

namespace Tests\Unit;

use App\Models\News;
use Tests\TestCase;

class NewsTest extends TestCase
{
    /** @test */
    function it_returns_native_title()
    {
        $news = $this->createTestNews();

        $this->assertEquals('Welcome new player', $news->title);

        app()->setLocale('ru');

        $this->assertEquals('Приветствуем нового игрока', $news->title);
    }

    /** @test */
    function it_returns_native_body()
    {
        $news = $this->createTestNews();

        $this->assertEquals("Our number has replenished. Let's warmly welcome player Nata. Good luck with the races.", $news->body);

        app()->setLocale('ru');

        $this->assertEquals('Наши ряды пополнились. Давайте тепло, как мы умеем, поприветствуем нового игрока Nata. И удачи в гонках.', $news->body);
    }

    /** @test */
    function it_return_a_slug()
    {
        $this->assertEquals('welcome-new-player-00000001', $this->createTestNews()->slug);
    }

    /** @test */
    function it_has_unique_slug()
    {
        $this->assertEquals('welcome-new-player-00000001', $this->createTestNews()->slug);
        $this->assertEquals('welcome-new-player-00000002', $this->createTestNews()->slug);
    }

    protected function createTestNews(): News
    {
        return News::factory()->create([
            'title_en' => 'Welcome new player',
            'title_ru' => 'Приветствуем нового игрока',
            'body_en' => "Our number has replenished. Let's warmly welcome player Nata. Good luck with the races.",
            'body_ru' => 'Наши ряды пополнились. Давайте тепло, как мы умеем, поприветствуем нового игрока Nata. И удачи в гонках.',
        ]);
    }
}
