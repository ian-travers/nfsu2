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
        $playerInfo = (new PlayerInfo($this->player))->statistics();

        $this->emitTo('search-result', 'found', $playerInfo, $this->player);
    }

    public function render()
    {
        return view('livewire.search-server-player');
    }
}
