<?php

namespace App\Http\Livewire\Dashboard;

use App\Settings\SitePointsSettings;
use Livewire\Component;

class DashboardSitePoints extends Component
{
    public string $tourneyFirst = '';
    public string $tourneySecond = '';
    public string $tourneyThird = '';
    public string $tourneyFourth = '';
    public string $tourneyFifthPlus = '';

    public function mount()
    {
        $this->tourneyFirst = app(SitePointsSettings::class)->tourney_first;
        $this->tourneySecond = app(SitePointsSettings::class)->tourney_second;
        $this->tourneyThird = app(SitePointsSettings::class)->tourney_third;
        $this->tourneyFourth = app(SitePointsSettings::class)->tourney_fourth;
        $this->tourneyFifthPlus = app(SitePointsSettings::class)->tourney_fifth_plus;
    }

    protected function rules()
    {
        return [
            'tourneyFirst' => 'required|integer|min:0',
            'tourneySecond' => 'required|integer|min:0',
            'tourneyThird' => 'required|integer|min:0',
            'tourneyFourth' => 'required|integer|min:0',
            'tourneyFifthPlus' => 'required|integer|min:0',
        ];
    }

    public function submit()
    {
        $this->validate();

        $settings = app(SitePointsSettings::class);
        $settings->tourney_first = (int)$this->tourneyFirst;
        $settings->tourney_second = (int)$this->tourneySecond;
        $settings->tourney_third = (int)$this->tourneyThird;
        $settings->tourney_fourth = (int)$this->tourneyFourth;
        $settings->tourney_fifth_plus = (int)$this->tourneyFifthPlus;

        $settings->save();

        $this->emitTo('generic-alert', 'saved');
    }

    public function render()
    {
        return view('livewire.dashboard.site-points');
    }
}
