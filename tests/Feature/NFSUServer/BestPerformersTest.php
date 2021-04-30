<?php

namespace Tests\Feature\NFSUServer;

use Tests\TestCase;

class BestPerformersTest extends TestCase
{
    /** @test */
    function it_shows_the_market_street()
    {
        $this->get('server/best-performers/circuit/1001')
            ->assertSee(['TheRo', '45.03', 'Mazda RX-7', 'forward']);
    }

    /** @test */
    function it_shows_the_stadium()
    {
        $this->get('server/best-performers/circuit/1002')
            ->assertSee(['Just4lulz', '47.42', 'Mazda RX-7', 'forward']);
    }

    /** @test */
    function it_shows_the_olympic_square()
    {
        $this->get('server/best-performers/circuit/1003')
            ->assertSee(['8man', '38.34', 'Mazda RX-7', 'forward']);
    }

    /** @test */
    function it_shows_the_terminal()
    {
        $this->get('server/best-performers/circuit/1004')
            ->assertSee(['Just4lulz', '42.88', 'Mazda RX-7', 'forward']);
    }

    /** @test */
    function it_shows_the_atlantica()
    {
        $this->get('server/best-performers/circuit/1005')
            ->assertSee(['Just4lulz', '37.04','Mazda RX-7', 'forward']);
    }

    /** @test */
    function it_shows_the_inner_city()
    {
        $this->get('server/best-performers/circuit/1006')
            ->assertSee(['I82much', '38.64', 'Mazda Miata MX-5', 'forward']);
    }

    /** @test */
    function it_shows_the_port_royal()
    {
        $this->get('server/best-performers/circuit/1007')
            ->assertSee(['I82much', '39.09', 'Mazda Miata MX-5', 'forward']);
    }

    /** @test */
    function it_shows_the_national_rail()
    {
        $this->get('server/best-performers/circuit/1008')
            ->assertSee(['I82much', '38.19', 'Mazda Miata MX-5', 'forward']);
    }

    /** @test */
    function it_shows_the_liberty_gardens()
    {
        $this->get('server/best-performers/sprint/1102')
            ->assertSee(['samurai', '1:25.51', 'Mazda RX-7', 'forward']);
    }

    /** @test */
    function it_shows_the_broadway()
    {
        $this->get('server/best-performers/sprint/1103')
            ->assertSee(['Ron123', '2:19.86', 'Toyota Supra', 'reverse']);
    }

    /** @test */
    function it_shows_the_lock_up()
    {
        $this->get('server/best-performers/sprint/1104')
            ->assertSee(['Ron123', '2:38.01', 'Toyota Supra', 'forward']);
    }

    /** @test */
    function it_shows_the_9th_frey()
    {
        $this->get('server/best-performers/sprint/1105')
            ->assertSee(['Ron123', '2:25.67', 'Toyota Supra', 'forward']);
    }

    /** @test */
    function it_shows_the_bedard_bridge()
    {
        $this->get('server/best-performers/sprint/1106')
            ->assertSee(['Interpolytor', '2:10.25', 'Mazda RX-7', 'forward']);
    }

    /** @test */
    function it_shows_the_spillway()
    {
        $this->get('server/best-performers/sprint/1107')
            ->assertSee(['Interpolytor', '2:48.36', 'Mazda RX-7', 'forward']);
    }

    /** @test */
    function it_shows_the_1st_ave_truck_stop()
    {
        $this->get('server/best-performers/sprint/1108')
            ->assertSee(['Interpolytor', '2:03.43', 'Mazda RX-7', 'forward']);
    }

    /** @test */
    function it_shows_the_7th_sparling()
    {
        $this->get('server/best-performers/sprint/1109')
            ->assertSee(['agressor94', '1:46.62', 'Acura RSX', 'reverse']);
    }

    /** @test */
    function it_shows_the_14th_and_vine_construction()
    {
        $this->get('server/best-performers/drag/1201')
            ->assertSee(['fancy', '18.79', 'Mazda RX-7', 'forward']);
    }

    /** @test */
    function it_shows_the_highway_1()
    {
        $this->get('server/best-performers/drag/1202')
            ->assertSee(['fancy', '18.94', 'Mazda RX-7', 'forward']);
    }

    /** @test */
    function it_shows_the_main_street()
    {
        $this->get('server/best-performers/drag/1206')
            ->assertSee(['fancy', '19.36', 'Mazda RX-7', 'forward']);
    }

    /** @test */
    function it_shows_the_commercial()
    {
        $this->get('server/best-performers/drag/1207')
            ->assertSee(['fancy', '19.89', 'Mazda RX-7', 'reverse']);
    }

    /** @test */
    function it_shows_the_14th_and_vine()
    {
        $this->get('server/best-performers/drag/1210')
            ->assertSee(['MasterrRX7', '18.68', 'Mazda RX-7', 'forward']);
    }

    /** @test */
    function it_shows_the_main_street_construction()
    {
        $this->get('server/best-performers/drag/1214')
            ->assertSee(['TheRo', '20.64', 'Mazda RX-7', 'forward']);
    }


    /** @test */
    function it_shows_the_drift_track_1()
    {
        $this->get('server/best-performers/drift/1301')
            ->assertSee(['LSDxALEX', '125 081', 'Acura Integra TypeR', 'forward']);
    }

    /** @test */
    function it_shows_the_drift_track_2()
    {
        $this->get('server/best-performers/drift/1302')
            ->assertSee(['Izzibaew', '35 061', 'Mitsubishi Lancer', 'forward']);
    }

    /** @test */
    function it_shows_the_drift_track_3()
    {
        $this->withoutExceptionHandling();
        $this->get('server/best-performers/drift/1303')
            ->assertSee(['Izzibaew', '17 596', 'Mitsubishi Lancer', 'forward']);
    }

    /** @test */
    function it_shows_the_drift_track_4()
    {
        $this->get('server/best-performers/drift/1304')
            ->assertSee(['LSDxALEX', '365 445', 'Acura Integra TypeR', 'forward']);
    }

    /** @test */
    function it_shows_the_drift_track_5()
    {
        $this->get('server/best-performers/drift/1305')
            ->assertSee(['LSDxALEX', '216 591', 'Acura Integra TypeR', 'forward']);
    }

    /** @test */
    function it_shows_the_drift_track_6()
    {
        $this->get('server/best-performers/drift/1306')
            ->assertSee(['8man', '183 999', 'Subaru Impreza', 'forward']);
    }

    /** @test */
    function it_shows_the_drift_track_7()
    {
        $this->get('server/best-performers/drift/1307')
            ->assertSee(['LSDxALEX','530 916', 'Acura Integra TypeR', 'forward']);
    }

    /** @test */
    function it_shows_the_drift_track_8()
    {
        $this->get('server/best-performers/drift/1308')
            ->assertSee(['Ilia', '61 968', 'Mazda RX-7', 'forward']);
    }

    /** @test */
    function it_redirects_properly()
    {
        $this->get('/server/best-performers')
            ->assertRedirect('/server/best-performers/circuit/1001');
    }
}
