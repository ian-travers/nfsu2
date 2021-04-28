<?php

namespace Tests\Feature\NFSUServer;

use App\Models\NFSUServer\RealServer;
use Tests\TestCase;

class MonitorTest extends TestCase
{
    /** @test */
    function monitor_shows_the_necessary_info()
    {
        $ip = config('nfsu-server.ip');
        $port = config('nfsu-server.port');
        $server = new RealServer($ip, $port);


        $response = $this->get('server/monitor')
            ->assertSee($server->ip());

        if ($server->isOnline()) {
            $response
                ->assertSee('Players')
                ->assertSee('Online')
                ->assertSee('2.5');
        } else {
            $response
                ->assertSee('Server is offline');
        }
    }
}
