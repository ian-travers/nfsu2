<?php

namespace App\Http\Livewire\Dashboard;

use App\Settings\SeasonSettings;
use Livewire\Component;

class DashboardSeason extends Component
{
    public string $index = '';
    public bool $suspend = false;

    public function mount()
    {
        $this->index = app(SeasonSettings::class)->index;
        $this->suspend = app(SeasonSettings::class)->suspend;
    }

    protected function rules()
    {
        return [
            'index' => 'required|integer|min:1|max:255',
        ];
    }

    public function complete()
    {
        $this->validate();

        $this->index++;

        $settings = app(SeasonSettings::class);
        $settings->index = (int)$this->index;

        $settings->save();

        $this->emitTo('generic-alert', 'seasonComplete');
    }

    public function suspend()
    {
        $this->suspend = true;

        $settings = app(SeasonSettings::class);
        $settings->suspend = (int)$this->suspend;

        $settings->save();

        $this->emitTo('generic-alert', 'seasonSuspend');
    }

    public function resume()
    {
        $this->suspend = false;

        $settings = app(SeasonSettings::class);
        $settings->suspend = (int)$this->suspend;

        $settings->save();

        $this->emitTo('generic-alert', 'seasonResume');
    }

    public function render()
    {
        return view('livewire.dashboard.season');
    }
}
