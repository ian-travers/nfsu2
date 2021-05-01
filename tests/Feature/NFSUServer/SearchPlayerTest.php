<?php

namespace Tests\Feature\NFSUServer;

use Tests\TestCase;

class SearchPlayerTest extends TestCase
{
    /** @test */
    function a_ratings_page_contains_the_search_livewire_component()
    {
        $this->get('/server/ratings/overall')
            ->assertSeeLivewire('search-server-player');
    }
}
