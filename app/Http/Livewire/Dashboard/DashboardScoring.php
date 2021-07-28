<?php

namespace App\Http\Livewire\Dashboard;

use App\Settings\ScoringSettings;
use Livewire\Component;

class DashboardScoring extends Component
{
    public string $heatRegularFirst = '';
    public string $heatRegularSecond = '';
    public string $heatRegularThird = '';
    public string $heatRegularFourth = '';

    public string $heatFinalFirst = '';
    public string $heatFinalSecond = '';
    public string $heatFinalThird = '';
    public string $heatFinalFourth = '';

    public function mount()
    {
        $this->heatRegularFirst = app(ScoringSettings::class)->heat_regular_first;
        $this->heatRegularSecond = app(ScoringSettings::class)->heat_regular_second;
        $this->heatRegularThird = app(ScoringSettings::class)->heat_regular_third;
        $this->heatRegularFourth = app(ScoringSettings::class)->heat_regular_fourth;

        $this->heatFinalFirst = app(ScoringSettings::class)->heat_final_first;
        $this->heatFinalSecond = app(ScoringSettings::class)->heat_final_second;
        $this->heatFinalThird = app(ScoringSettings::class)->heat_final_third;
        $this->heatFinalFourth = app(ScoringSettings::class)->heat_final_fourth;
    }

    protected function rules()
    {
        return [
            'heatRegularFirst' => 'required|integer|min:0',
            'heatRegularSecond' => 'required|integer|min:0',
            'heatRegularThird' => 'required|integer|min:0',
            'heatRegularFourth' => 'required|integer|min:0',

            'heatFinalFirst' => 'required|integer|min:0',
            'heatFinalSecond' => 'required|integer|min:0',
            'heatFinalThird' => 'required|integer|min:0',
            'heatFinalFourth' => 'required|integer|min:0',
        ];
    }

    public function submit()
    {
        $this->validate();

        $settings = app(ScoringSettings::class);
        $settings->heat_regular_first = (int)$this->heatRegularFirst;
        $settings->heat_regular_second = (int)$this->heatRegularSecond;
        $settings->heat_regular_third = (int)$this->heatRegularThird;
        $settings->heat_regular_fourth = (int)$this->heatRegularFourth;

        $settings->heat_final_first = (int)$this->heatFinalFirst;
        $settings->heat_final_second = (int)$this->heatFinalSecond;
        $settings->heat_final_third = (int)$this->heatFinalThird;
        $settings->heat_final_fourth = (int)$this->heatFinalFourth;

        $settings->save();

        $this->emitTo('generic-alert', 'saved');
    }

    public function render()
    {
        return view('livewire.dashboard.scoring');
    }
}
