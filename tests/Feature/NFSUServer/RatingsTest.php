<?php

namespace Tests\Feature\NFSUServer;

use Tests\TestCase;

class RatingsTest extends TestCase
{
    /** @test */
    function it_shows_the_overall_rating()
    {
        $this->get('/server/ratings/overall')
            ->assertSee(['FLASH', '7 788 250', '919', '248', '77%']);
    }

    /** @test */
    function it_shows_the_circuit_rating()
    {
        $this->get('/server/ratings/circuit')
            ->assertSee(['FLASH', '14 056 629', '226', '57', '75%']);
    }

    /** @test */
    function it_shows_the_sprint_rating()
    {
        $this->get('/server/ratings/sprint')
            ->assertSee(['FLASH', '626 204', '175', '49', '76%']);
    }

    /** @test */
    function it_shows_the_drag_rating()
    {
        $this->get('/server/ratings/drag')
            ->assertSee(['FLASH', '618 026', '275', '96', '74%']);
    }

    /** @test */
    function it_shows_the_drift_rating()
    {
        $this->get('/server/ratings/drift')
            ->assertSee(['FLASH', '15 852 142', '243', '46', '82%']);
    }

    /** @test */
    function it_redirects_properly()
    {
        $this->get('/server/ratings')
            ->assertRedirect('/server/ratings/overall');
    }
}
