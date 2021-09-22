<?php

namespace App\Http\Livewire\Dashboard;

use App\Events\SeasonCompleted;
use App\Settings\SeasonSettings;
use Illuminate\Support\Facades\Gate;
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
        if (Gate::denies('admin')) {
            session()->flash('flash', [
                'type' => 'error',
                'message' => __('You have no permission to complete the season.'),
            ]);
        } else {
            $this->validate();

            event(new SeasonCompleted($this->index));

            $this->index++;

            $settings = app(SeasonSettings::class);
            $settings->index = (int)$this->index;

            $settings->save();

            session()->flash('flash', [
                'type' => 'success',
                'message' => __('Season has been completed. New season starts.'),
            ]);
        }

        redirect()->route('adm.dashboard');
    }

    public function suspend()
    {
        $this->suspend = true;

        $settings = app(SeasonSettings::class);
        $settings->suspend = (int)$this->suspend;

        $settings->save();

        session()->flash('flash', [
            'type' => 'success',
            'message' => __('Season has been suspended.'),
        ]);

        return redirect()->route('adm.dashboard');
    }

    public function resume()
    {
        $this->suspend = false;

        $settings = app(SeasonSettings::class);
        $settings->suspend = (int)$this->suspend;

        $settings->save();

        session()->flash('flash', [
            'type' => 'success',
            'message' => __('Season has been resumed.'),
        ]);

        return redirect()->route('adm.dashboard');
    }

    public function render()
    {
        return view('livewire.dashboard.season');
    }
}
