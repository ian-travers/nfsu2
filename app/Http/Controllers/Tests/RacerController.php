<?php

namespace App\Http\Controllers\Tests;

use App\Http\Controllers\Controller;
use App\Models\Quiz\Question;
use App\Models\User;
use App\Settings\RacerTestSettings;
use DomainException;

class RacerController extends Controller
{
    public function show()
    {
        return view('frontend.test.racer', [
            'questions' => Question::getRacerTestQuestions(),
            'allowed_errors_count' => app(RacerTestSettings::class)->allowed_errors_count,
            'title' => 'Racer test',
        ]);
    }

    public function check(RacerTestSettings $settings)
    {
        $form = request()->validate([
            'racer-test-form' => 'required',
        ]);

        $errorsCount = $settings->questions_count - count($form['racer-test-form']);

        foreach ($form['racer-test-form'] as $q => $a) {
            $question = Question::findOrFail($q);

            if (!$question->isCorrectAnswer($a)) {
                $errorsCount++;
            }
        }

        $result = $errorsCount - $settings->allowed_errors_count;

        if ($result > 0) {
            return back()->with('flash', [
                'type' => 'warning',
                'message' => __('Test failed. Errors count: :count', ['count' => $errorsCount]),
            ]);
        }

        try {
            User::setRacer(auth()->user());
        } catch (DomainException $e) {
            return back()->with('flash', [
                'type' => 'warning',
                'message' => $e->getMessage(),
            ]);
        }

        return back()->with('flash', [
            'type' => 'success',
            'message' => __('Test passed! You got the racer promotion and will be able to signup for tourneys'),
        ]);
    }
}
