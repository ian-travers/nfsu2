<?php

namespace Tests\Feature\Backend\Quiz;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function admin_can_create_quiz_question()
    {
        $this->withoutExceptionHandling();
        $this->signIn(User::factory()->admin()->create());

        $attributes = [
            'question_en' => 'in en',
            'question_ru' => 'in ru',
            'correct_answer' => 1,
        ];

        $this->post('/adm/quiz', $attributes);

        $this->assertDatabaseHas('quiz_questions', $attributes);
    }

    /* @TODO  I need more tests */
}
