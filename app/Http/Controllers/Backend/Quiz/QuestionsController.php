<?php

namespace App\Http\Controllers\Backend\Quiz;

use App\Http\Controllers\Controller;
use App\Models\Quiz\Question;

class QuestionsController extends Controller
{
    public function index()
    {
        return view('backend.quiz.questions.index', [
            'title' => __('Quiz'),
            'questions' => Question::paginate(10),
        ]);
    }

    public function show(Question $question)
    {
        return view('backend.quiz.questions.show', [
            'title' => 'View quiz question',
            'question' => $question,
        ]);
    }

    public function create()
    {
        return view('backend.quiz.questions.create', [
            'title' => __('Create quiz question'),
            'question' => new Question(),
        ]);
    }

    public function store()
    {
        Question::create($this->validateRequest());

        return redirect()->route('adm.quiz.question.index')->with('flash', [
            'type' => 'success',
            'message' => 'Question has been created.'
        ]);
    }

    public function edit(Question $question)
    {
        return view('.backend.quiz.questions.edit', [
            'title' => 'Edit quiz question',
            'question' => $question,
        ]);
    }

    public function update(Question $question)
    {
        $question->update($this->validateRequest());

        return redirect()->route('adm.quiz.question.index')->with('flash', [
            'type' => 'success',
            'message' => __('Quiz question has been updated.'),
        ]);
    }

    public function remove(Question $question)
    {
        $question->delete();

        return redirect()->route('adm.quiz.question.index')->with('flash', [
            'type' => 'success',
            'message' => __('Quiz question has been deleted.'),
        ]);
    }

    protected function validateRequest()
    {
        return request()->validate([
            'question_en' => 'required|string|max:255',
            'question_ru' => 'required|string|max:255',
            'correct_answer' => 'required|max:1|regex:/^[1-9]{1}$/s',
        ]);
    }
}
