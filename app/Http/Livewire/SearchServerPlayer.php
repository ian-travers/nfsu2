<?php

namespace App\Http\Livewire;

use App\Models\NFSUServer\PlayerInfo;
use Livewire\Component;

class SearchServerPlayer extends Component
{
    public string $player = '';

    protected $queryString = [
        'player' => ['except' => ''],
    ];

    public function search()
    {
        if (strlen($this->player) > 2) {
            $playerInfo = (new PlayerInfo($this->player))->statistics();

            if (empty($playerInfo)) {
                session()->flash('flash', [
                    'type' => 'warning',
                    'message' => __("There is no information about player with username ':name'", ['name' => $this->player]),
                ]);

                return redirect()->route('server.ratings', 'overall');
            }

            $this->emitTo('search-result', 'found', $playerInfo, $this->player);
        }
    }

    public function render()
    {
        return view('livewire.search-server-player');
    }
}
