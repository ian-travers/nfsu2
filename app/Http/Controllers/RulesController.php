<?php

namespace App\Http\Controllers;

use App\Models\Quiz\Question;

class RulesController extends Controller
{
    public function show()
    {
        return view('frontend.rules.show', [
            'title' => __('Rules'),
            'questions' => Question::all(),
        ]);
    }

    public function check()
    {
        $form = request()->validate([
            'quiz-form' => 'required',
        ]);

        $errorsCount = Question::count() - count($form['quiz-form']);

        foreach (request('quiz-form') as $q => $a) {
            $question = Question::findOrFail($q);

            if (!$question->isCorrectAnswer($a)) {
                $errorsCount++;
            }
        }

        if ($errorsCount) {
            return back()->with('flash', [
                'type' => 'warning',
                'message' => __('Quiz failed. Errors count: :count', ['count' => $errorsCount]),
            ]);
        }

        return back()->with('flash', [
            'type' => 'success',
            'message' => __('Quiz passed!'),
        ]);
    }
}
