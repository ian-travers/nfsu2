<?php

namespace App\Http\Livewire\Dashboard;

use App\Settings\ScoringSettings;
use Livewire\Component;

class DashboardScoring extends Component
{
    public string $tourneyRegularFirst = '';
    public string $tourneyRegularSecond = '';
    public string $tourneyRegularThird = '';
    public string $tourneyRegularFourth = '';

    public string $tourneyFinalFirst = '';
    public string $tourneyFinalSecond = '';
    public string $tourneyFinalThird = '';
    public string $tourneyFinalFourth = '';

    public function mount()
    {
        $this->tourneyRegularFirst = app(ScoringSettings::class)->tourney_regular_first;
        $this->tourneyRegularSecond = app(ScoringSettings::class)->tourney_regular_second;
        $this->tourneyRegularThird = app(ScoringSettings::class)->tourney_regular_third;
        $this->tourneyRegularFourth = app(ScoringSettings::class)->tourney_regular_fourth;

        $this->tourneyFinalFirst = app(ScoringSettings::class)->tourney_final_first;
        $this->tourneyFinalSecond = app(ScoringSettings::class)->tourney_final_second;
        $this->tourneyFinalThird = app(ScoringSettings::class)->tourney_final_third;
        $this->tourneyFinalFourth = app(ScoringSettings::class)->tourney_final_fourth;
    }

    protected function rules()
    {
        return [
            'tourneyRegularFirst' => 'required|integer|min:0',
            'tourneyRegularSecond' => 'required|integer|min:0',
            'tourneyRegularThird' => 'required|integer|min:0',
            'tourneyRegularFourth' => 'required|integer|min:0',

            'tourneyFinalFirst' => 'required|integer|min:0',
            'tourneyFinalSecond' => 'required|integer|min:0',
            'tourneyFinalThird' => 'required|integer|min:0',
            'tourneyFinalFourth' => 'required|integer|min:0',
        ];
    }

    public function submit()
    {
        $this->validate();

        $settings = app(ScoringSettings::class);
        $settings->tourney_regular_first = (int)$this->tourneyRegularFirst;
        $settings->tourney_regular_second = (int)$this->tourneyRegularSecond;
        $settings->tourney_regular_third = (int)$this->tourneyRegularThird;
        $settings->tourney_regular_fourth = (int)$this->tourneyRegularFourth;

        $settings->tourney_final_first = (int)$this->tourneyFinalFirst;
        $settings->tourney_final_second = (int)$this->tourneyFinalSecond;
        $settings->tourney_final_third = (int)$this->tourneyFinalThird;
        $settings->tourney_final_fourth = (int)$this->tourneyFinalFourth;

        $settings->save();

        $this->emitTo('generic-alert', 'saved');
    }

    public function render()
    {
        return view('livewire.dashboard.scoring');
    }
}
