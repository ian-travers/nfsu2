<?php

namespace Tests\Feature\Backend\Quiz;

use App\Models\Quiz\Question;
use App\Models\User;
use Tests\TestCase;

class QuestionsTest extends TestCase
{
    /** @test */
    function admin_can_create_quiz_question()
    {
        $this->signIn(User::factory()->admin()->create());

        $attributes = [
            'question_en' => 'in en',
            'question_ru' => 'in ru',
            'correct_answer' => 1,
        ];

        $this->post('/adm/quiz', $attributes);

        $this->assertDatabaseHas('quiz_questions', $attributes);
    }

    /** @test */
    function admin_can_edit_quiz_question()
    {
        /** @var Question $question */
        $question = Question::factory()->create();

        $this->signIn(User::factory()->admin()->create());

        $attributes = [
            'question_en' => 'ENG UPD',
            'question_ru' => 'RU UPD',
            'correct_answer' => 7,
        ];

        $this->patch("/adm/quiz/{$question->id}", $attributes);

        $this->assertDatabaseHas('quiz_questions', $attributes);
    }

    /** @test */
    function admin_can_delete_quiz_question()
    {
        /** @var Question $question */
        $question = Question::factory()->create();

        $this->assertDatabaseCount('quiz_questions', 1);

        $this->signIn(User::factory()->admin()->create());

        $this->delete("/adm/quiz/{$question->id}");

        $this->assertDatabaseCount('quiz_questions', 0);
    }

    /** @test */
    function deleting_quiz_question_cascade_deletes_related_answers()
    {
        /** @var Question $question */
        $question = Question::factory()->create();

        $question->addAnswer([
            'answer_en' => 'ENG',
            'answer_ru' => 'RUS',
            'index' => 1,
        ]);

        $this->assertDatabaseCount('quiz_questions', 1);
        $this->assertDatabaseCount('quiz_answers', 1);

        $this->signIn(User::factory()->admin()->create());

        $this->delete("/adm/quiz/{$question->id}");

        $this->assertDatabaseCount('quiz_questions', 0);
        $this->assertDatabaseCount('quiz_answers', 0);
    }
}
