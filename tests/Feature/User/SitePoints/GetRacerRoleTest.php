<?php

namespace Tests\Feature\User\SitePoints;

use App\Models\Quiz\Question;
use App\Models\User;
use App\Settings\RacerTestSettings;
use Database\Seeders\QuizSeeder;
use Tests\TestCase;

class GetRacerRoleTest extends TestCase
{
    /** @test */
    function user_gains_site_points_when_get_racer_role()
    {
        $this->seed(QuizSeeder::class);

        /** @var User $user */
        $user = User::factory()->create();
        $this->signIn($user);

        $questions = Question::get()->take(app(RacerTestSettings::class)->questions_count);

        // knowingly correct form data
        $form['racer-test-form'] = [];
        foreach ($questions as $question) {
            $form['racer-test-form'] += [$question->id => $question->correct_answer];
        }

        $this->post('/tests/racer', $form);

        $this->assertEquals(25, $user->site_points);
    }

    /** @test */
    function user_cannot_gains_site_points_twice()
    {
        $this->seed(QuizSeeder::class);

        /** @var User $user */
        $user = User::factory()->create();
        $this->signIn($user);

        $questions = Question::get()->take(app(RacerTestSettings::class)->questions_count);

        // knowingly correct form data
        $form['racer-test-form'] = [];
        foreach ($questions as $question) {
            $form['racer-test-form'] += [$question->id => $question->correct_answer];
        }

        $this->post('/tests/racer', $form);

        $this->assertEquals(25, $user->site_points);

        $this->post('/tests/racer', $form);

        $this->assertEquals(25, $user->site_points);
    }
}
