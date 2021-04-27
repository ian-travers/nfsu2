<?php

namespace Tests\Unit\NFSUServer;

use Tests\TestCase;

class MonitorTest extends TestCase
{
    public $server;

    protected function setUp(): void
    {
        parent::setUp();

        $this->server = new  FakeServer();
    }

    /** @test */
    function it_is_online_with_valid_ip_and_port()
    {
        $this->assertTrue($this->server->isOnline());
    }

    /** @test */
    function online_server_returns_status()
    {
        $this->assertIsBool($this->server->isOnline());
    }

    /** @test */
    function online_server_returns_players_count_as_int()
    {
        $this->assertIsInt($this->server->playersCount());
    }

    /** @test */
    function online_server_returns_rooms_count_as_int()
    {
        $this->assertIsInt($this->server->roomsCount());
    }

    /** @test */
    function online_server_returns_online_time_in_seconds_as_int()
    {
        $this->assertIsInt($this->server->onlineInSeconds());
    }

    /** @test */
    function online_server_returns_platform_as_string()
    {
        $this->assertIsString($this->server->platform());
    }

    /** @test */
    function online_server_returns_version_as_string()
    {
        $this->assertIsString($this->server->version());
    }

    /** @test */
    function online_server_returns_name_as_string()
    {
        $this->assertIsString($this->server->name());
    }

    /** @test */
    function online_server_returns_is_ban_cheaters()
    {
        $this->server->version() >= '2'
            ? $this->assertIsBool($this->server->isBanCheaters())
            : $this->assertNull($this->server->isBanCheaters());
    }

    /** @test */
    function online_server_returns_is_ban_new_rooms()
    {
        $this->server->version() >= '2'
            ? $this->assertIsBool($this->server->isBanNewRooms())
            : $this->assertNull($this->server->isBanNewRooms());
    }

    /** @test */
    function online_server_returns_players_in_race()
    {
        $this->server->version() >= '2'
            ? $this->assertIsInt($this->server->playersInRaces())
            : $this->assertNull($this->server->playersInRaces());
    }

    /** @test */
    function online_server_returns_circuit_ranked_rooms_array()
    {
        $this->assertIsArray($this->server->roomsCircuitRanked());
    }

    /** @test */
    function online_server_returns_circuit_unranked_rooms_array()
    {
        $this->assertIsArray($this->server->roomsCircuitUnranked());
    }

    /** @test */
    function online_server_returns_sprint_ranked_rooms_array()
    {
        $this->assertIsArray($this->server->roomsSprintRanked());
    }

    /** @test */
    function online_server_returns_sprint_unranked_rooms_array()
    {
        $this->assertIsArray($this->server->roomsSprintUnranked());
    }

    /** @test */
    function online_server_returns_drift_ranked_rooms_array()
    {
        $this->assertIsArray($this->server->roomsDriftRanked());
    }

    /** @test */
    function online_server_returns_drift_unranked_rooms_array()
    {
        $this->assertIsArray($this->server->roomsDriftUnranked());
    }

    /** @test */
    function online_server_returns_drag_ranked_rooms_array()
    {
        $this->assertIsArray($this->server->roomsDragRanked());
    }

    /** @test */
    function online_server_returns_drag_unranked_rooms_array()
    {
        $this->assertIsArray($this->server->roomsDragUnranked());
    }
}
