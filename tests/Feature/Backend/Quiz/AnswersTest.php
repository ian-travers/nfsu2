<?php

namespace Tests\Feature\Backend\Quiz;

use App\Models\Quiz\Answer;
use App\Models\Quiz\Question;
use App\Models\User;
use Tests\TestCase;

class AnswersTest extends TestCase
{
    /** @test */
    function admin_can_add_answer_to_existing_question()
    {
        /** @var Question $question */
        $question = Question::factory()->create();

        $this->signIn(User::factory()->admin()->create());

        $attributes = [
            'answer_en' => 'ENG',
            'answer_ru' => 'RU',
            'index' => 1,
        ];

        $this->assertDatabaseCount('quiz_answers', 0);

        $this->post("/adm/quiz/{$question->id}/answers", $attributes);

        $this->assertDatabaseCount('quiz_answers', 1);
        $this->assertEquals(1, $question->answers()->count());
    }

    /** @test */
    function admin_can_edit_quiz_answer()
    {
        /** @var Question $question */
        $question = Question::factory()->create();
        $question->addAnswer(Answer::factory()->make()->toArray());

        $this->signIn(User::factory()->admin()->create());

        /** @var Answer $answer */
        $answer = $question->answers()->first();

        $attributes = [
            'answer_en' => 'ENG UPD',
            'answer_ru' => 'RU UPD',
            'index' => 2,
        ];

        $this->patch("/adm/quiz/{$question->id}/answers/{$answer->id}", $attributes);

        $this->assertDatabaseHas('quiz_answers', $attributes);
        $this->assertEquals(1, $question->answers()->count());
    }

    /** @test */
    function admin_cannot_edit_answer_from_another_question()
    {
        /** @var Question $question */
        $question = Question::factory()->create();
        $question->addAnswer(Answer::factory()->make()->toArray());

        /** @var Question $anotherQuestion */
        $anotherQuestion = Question::factory()->create();
        $anotherQuestion->addAnswer(Answer::factory()->make()->toArray());

        /** @var Answer $anotherAnswer */
        $anotherAnswer = $anotherQuestion->answers()->first();

        $this->signIn(User::factory()->admin()->create());

        $this->patch("/adm/quiz/{$question->id}/answers/{$anotherAnswer->id}")
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'This answer cannot be updated. It is related to another question.',
            ]);
    }

    /** @test */
    function admin_can_delete_quiz_answer()
    {
        /** @var Question $question */
        $question = Question::factory()->create();
        $question->addAnswer(Answer::factory()->make()->toArray());

        /** @var Answer $answer */
        $answer = $question->answers()->first();

        $this->signIn(User::factory()->admin()->create());

        $this->assertDatabaseCount('quiz_answers', 1);

        $this->delete("/adm/quiz/{$question->id}/answers/{$answer->id}");

        $this->assertDatabaseCount('quiz_answers', 0);
    }

    /** @test */
    function admin_cannot_delete_answer_from_another_question()
    {
        /** @var Question $question */
        $question = Question::factory()->create();
        $question->addAnswer(Answer::factory()->make()->toArray());

        /** @var Question $anotherQuestion */
        $anotherQuestion = Question::factory()->create();
        $anotherQuestion->addAnswer(Answer::factory()->make()->toArray());

        /** @var Answer $anotherAnswer */
        $anotherAnswer = $anotherQuestion->answers()->first();

        $this->signIn(User::factory()->admin()->create());

        $this->delete("/adm/quiz/{$question->id}/answers/{$anotherAnswer->id}")
            ->assertSessionHas('flash', [
                'type' => 'error',
                'message' => 'This answer cannot be deleted. It is related to another question.',
            ]);


        $this->assertEquals(1, $question->answers()->count());
        $this->assertEquals(1, $anotherQuestion->answers()->count());
    }
}
