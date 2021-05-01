<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SearchResult extends Component
{
    public bool $isShow = false;
    public array $playerInfo = [];
    public string $playerName = '';

    protected $listeners = ['found'];

    public function found(array $playerInfo, string $playerName)
    {
        $this->playerInfo = $playerInfo;
        $this->playerName = $playerName;
        $this->isShow = true;
    }

    public function render()
    {
        return view('livewire.search-result');
    }
}
