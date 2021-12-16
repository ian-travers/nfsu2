<?php

namespace Tests\Feature\News;

use App\Models\Quiz\Question;
use App\Models\User;
use App\Settings\RacerTestSettings;
use Database\Seeders\QuizSeeder;
use Tests\TestCase;

class UserBecameRacerTest extends TestCase
{
    /** @test */
    function when_a_user_became_racer_related_news_item_is_created()
    {
        $this->seed(QuizSeeder::class);

        /** @var \App\Models\User $user */
        $user = User::factory()->create(['username' => 'jonny']);
        $this->signIn($user);

        $questions = Question::get()->take(app(RacerTestSettings::class)->questions_count);

        // knowingly correct form data
        $form['racer-test-form'] = [];
        foreach ($questions as $question) {
            $form['racer-test-form'] += [$question->id => $question->correct_answer];
        }

        $this->post('/tests/racer', $form);

        $this->assertDatabaseCount('news', 1);
        $this->assertDatabaseHas('news', ['title_en' => "jonny has been passed racer test"]);
    }
}
