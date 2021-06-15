<?php

namespace App\Http\Controllers\Tests;

use App\Http\Controllers\Controller;
use App\Models\Quiz\Question;
use App\Models\User;

class RacerController extends Controller
{
    public function show()
    {
        return view('frontend.test.racer', [
            'questions' => Question::getRacerTestQuestions(),
            'title' => 'Racer test',
        ]);
    }

    public function check()
    {
        $form = request()->validate([
            'racer-test-form' => 'required',
        ]);

        $errorsCount = config('tests.racer.questions_count') - count($form['racer-test-form']);

        foreach ($form['racer-test-form'] as $q => $a) {
            $question = Question::findOrFail($q);

            if (!$question->isCorrectAnswer($a)) {
                $errorsCount++;
            }
        }

        $result = $errorsCount - config('tests.racer.errors_allowed_count');

        if ($result > 0) {
            return back()->with('flash', [
                'type' => 'warning',
                'message' => __('Test failed. Errors count: :count', ['count' => $errorsCount]),
            ]);
        }

        User::setRacer(auth()->user());

        return back()->with('flash', [
            'type' => 'success',
            'message' => __('Test passed!. You got the racer promotion and will be able to signup for tourneys'),
        ]);
    }
}
