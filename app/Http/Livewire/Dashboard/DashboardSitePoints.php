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

    public string $competition = '';
    public string $post = '';
    public string $comment = '';
    public string $likeDislike = '';

    public function mount()
    {
        $this->tourneyFirst = app(SitePointsSettings::class)->tourney_first;
        $this->tourneySecond = app(SitePointsSettings::class)->tourney_second;
        $this->tourneyThird = app(SitePointsSettings::class)->tourney_third;
        $this->tourneyFourth = app(SitePointsSettings::class)->tourney_fourth;
        $this->tourneyFifthPlus = app(SitePointsSettings::class)->tourney_fifth_plus;

        $this->competition = app(SitePointsSettings::class)->competition;
        $this->post = app(SitePointsSettings::class)->post;
        $this->comment = app(SitePointsSettings::class)->comment;
        $this->likeDislike = app(SitePointsSettings::class)->like_dislike;
    }

    protected function rules()
    {
        return [
            'tourneyFirst' => 'required|integer|min:0',
            'tourneySecond' => 'required|integer|min:0',
            'tourneyThird' => 'required|integer|min:0',
            'tourneyFourth' => 'required|integer|min:0',
            'tourneyFifthPlus' => 'required|integer|min:0',


            'competition' => 'required|integer|min:0',
            'post' => 'required|integer|min:0',
            'comment' => 'required|integer|min:0',
            'likeDislike' => 'required|integer|min:0',
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

        $settings->competition =(int)$this->competition;
        $settings->post =(int)$this->post;
        $settings->comment =(int)$this->comment;
        $settings->like_dislike =(int)$this->likeDislike;

        $settings->save();

        $this->emitTo('generic-alert', 'saved');
    }

    public function render()
    {
        return view('livewire.dashboard.site-points');
    }
}
