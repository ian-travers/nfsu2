<?php

namespace Tests\Unit\NFSUServer;

use App\Models\NFSUServer\PlayerInfo;
use Tests\TestCase;

class PlayerInfoTest extends TestCase
{
    /** @test */
    function it_checks_whether_the_player_is_there()
    {
        $pi = new PlayerInfo('newbie');

        $this->assertTrue($pi->isExists());

        $pi = new PlayerInfo('fake-name');

        $this->assertFalse($pi->isExists());
    }

    /** @test */
    function it_returns_an_empty_array_when_the_player_doesnt_exist()
    {
        $pi = new PlayerInfo('fake-name');

        $this->assertEmpty($pi->statistics());
    }

    /** @test */
    function it_provides_full_info_on_an_existing_player()
    {
        $pi = new PlayerInfo('newbie');

        $statistics =$pi->statistics();

        $this->assertArrayHasKey('overall', $statistics);
        $this->assertArrayHasKey('circuit', $statistics);
        $this->assertArrayHasKey('sprint', $statistics);
        $this->assertArrayHasKey('drag', $statistics);
        $this->assertArrayHasKey('drift', $statistics);

        $this->assertEquals(15, $statistics['overall']['rating']);
        $this->assertEquals(523, $statistics['overall']['wins']);
        $this->assertEquals(550, $statistics['overall']['loses']);
        $this->assertEquals(644648, $statistics['overall']['REP']);

        $this->assertEquals(15, $statistics['circuit']['rating']);
        $this->assertEquals(274, $statistics['circuit']['wins']);
        $this->assertEquals(432, $statistics['circuit']['loses']);
        $this->assertEquals(2160779, $statistics['circuit']['REP']);

        $this->assertEquals(18, $statistics['sprint']['rating']);
        $this->assertEquals(163, $statistics['sprint']['wins']);
        $this->assertEquals(96, $statistics['sprint']['loses']);
        $this->assertEquals(7851, $statistics['sprint']['REP']);

        $this->assertEquals(23, $statistics['drag']['rating']);
        $this->assertEquals(70, $statistics['drag']['wins']);
        $this->assertEquals(17, $statistics['drag']['loses']);
        $this->assertEquals(9866, $statistics['drag']['REP']);

        $this->assertEquals(20, $statistics['drift']['rating']);
        $this->assertEquals(16, $statistics['drift']['wins']);
        $this->assertEquals(5, $statistics['drift']['loses']);
        $this->assertEquals(400100, $statistics['drift']['REP']);
    }
}
