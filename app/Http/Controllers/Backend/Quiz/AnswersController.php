<?php

namespace App\Http\Controllers\Backend\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Quiz\Answer;
use App\Models\Quiz\Question;

class AnswersController extends Controller
{

    public function create(Question $question)
    {
        return view('backend.quiz.answers.create', [
            'title' => __('Create quiz answer'),
            'question' => $question,
            'answer' => new Answer(),
        ]);
    }

    public function store(Question $question)
    {
        $question->addAnswer($this->validateRequest());

        return redirect()->route('adm.quiz.question.show', $question)->with('flash', [
            'type' => 'success',
            'message' => 'Answer has been created.'
        ]);
    }

    public function edit(Question $question, Answer $answer)
    {
        return view('.backend.quiz.answers.edit', [
            'title' => 'Edit quiz answer',
            'question' => $question,
            'answer' => $answer
        ]);
    }

    public function update(Question $question, Answer $answer)
    {
        if (!$answer->question->is($question)) {
            return redirect()->route('adm.quiz.question.show', $question)->with('flash', [
                'type' => 'error',
                'message' => __('This answer cannot be updated. It is related to another question.'),
            ]);
        }

        $answer->update($this->validateRequest());

        return redirect()->route('adm.quiz.question.show', $question)->with('flash', [
            'type' => 'success',
            'message' => __('Quiz answer has been updated.'),
        ]);
    }

    public function remove(Question $question, Answer $answer)
    {
        if (!$answer->question->is($question)) {
            return redirect()->route('adm.quiz.question.show', $question)->with('flash', [
                'type' => 'error',
                'message' => __('This answer cannot be deleted. It is related to another question.'),
            ]);
        }

        $answer->delete();

        return redirect()->route('adm.quiz.question.show', $question)->with('flash', [
            'type' => 'success',
            'message' => __('Quiz answer has been deleted.'),
        ]);
    }

    protected function validateRequest()
    {
        return request()->validate([
            'answer_en' => 'required|string|max:255',
            'answer_ru' => 'required|string|max:255',
            'index' => 'required|max:1|regex:/^[1-9]{1}$/s',
        ]);
    }
}
