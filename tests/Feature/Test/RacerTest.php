<?php

namespace Tests\Feature\Test;

use App\Models\Quiz\Question;
use App\Models\User;
use App\Settings\RacerTestSettings;
use Database\Seeders\QuizSeeder;
use Tests\TestCase;

class RacerTest extends TestCase
{
    /** @test */
    function user_may_visit_the_test_page()
    {
        $this->signIn();

        $this->get('/tests/racer')
            ->assertOk();
    }

    /** @test */
    function guest_cannot_visit_the_test_page()
    {
        $this->get('/tests/racer')
            ->assertRedirect('/login');
    }

    /** @test */
    function passing_the_test_gives_the_racer_role()
    {
        $this->seed(QuizSeeder::class);

        /** @var \App\Models\User $user */
        $user = User::factory()->create();
        $this->signIn($user);

        $this->assertFalse($user->isRacer());

        $questions = Question::get()->take(app(RacerTestSettings::class)->questions_count);

        // knowingly correct form data
        $form['racer-test-form'] = [];
        foreach ($questions as $question) {
            $form['racer-test-form'] += [$question->id => $question->correct_answer];
        }

        $this->post('/tests/racer', $form);

        $this->assertTrue($user->isRacer());
    }
}
