<?php

namespace App\Http\Livewire\Dashboard;

use App\RacerTestSettings;
use Livewire\Component;

class DashboardRacerTest extends Component
{
    public string $questionsCount = '';
    public string $allowedErrorsCount = '';

    public function mount()
    {
        $this->questionsCount = app(RacerTestSettings::class)->questions_count;
        $this->allowedErrorsCount = app(RacerTestSettings::class)->allowed_errors_count;
    }

    protected function rules()
    {
        return [
            'questionsCount' => 'required|integer|min:6|max:15',
            'allowedErrorsCount' => 'required|integer|min:0|max:3',
        ];
    }

    public function submit()
    {
        $this->validate();

        $settings = app(RacerTestSettings::class);
        $settings->questions_count = (int)$this->questionsCount;
        $settings->allowed_errors_count = (int)$this->allowedErrorsCount;

        $settings->save();

        $this->emitTo('generic-alert', 'saved');
    }

    public function render()
    {
        return view('livewire.dashboard.racer-test');
    }
}
