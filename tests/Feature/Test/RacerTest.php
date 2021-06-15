<?php

namespace Tests\Feature\Test;

use App\Models\User;
use Database\Seeders\QuizSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RacerTest extends TestCase
{
    use RefreshDatabase;

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

        // knowingly correct form data
        $form = [
            'test-form' => [
                1 => 1,
                2 => 2,
                3 => 2,
                4 => 3,
                5 => 3,
                6 => 3,
            ],
        ];

        $this->post('/tests/racer', $form);

        $this->assertTrue($user->isRacer());
    }
}
