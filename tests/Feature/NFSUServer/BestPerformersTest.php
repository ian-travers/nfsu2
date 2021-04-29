<?php

namespace Tests\Feature\NFSUServer;

use Tests\TestCase;

class BestPerformersTest extends TestCase
{
    /** @test */
    function it_shows_the_market_street()
    {
        $this->get('server/best-performers/circuit/1001')
            ->assertSee('Market Street')
            ->assertSee('TheRo')
            ->assertSee('45.03')
            ->assertSee('Mazda RX-7')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_stadium()
    {
        $this->get('server/best-performers/circuit/1002')
            ->assertSee('Stadium')
            ->assertSee('Just4lulz')
            ->assertSee('47.42')
            ->assertSee('Mazda RX-7')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_olympic_square()
    {
        $this->get('server/best-performers/circuit/1003')
            ->assertSee('Olympic Square')
            ->assertSee('8man')
            ->assertSee('38.34')
            ->assertSee('Mazda RX-7')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_terminal()
    {
        $this->get('server/best-performers/circuit/1004')
            ->assertSee('Terminal')
            ->assertSee('Just4lulz')
            ->assertSee('42.88')
            ->assertSee('Mazda RX-7')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_atlantica()
    {
        $this->get('server/best-performers/circuit/1005')
            ->assertSee('Terminal')
            ->assertSee('Just4lulz')
            ->assertSee('37.04')
            ->assertSee('Mazda RX-7')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_inner_city()
    {
        $this->get('server/best-performers/circuit/1006')
            ->assertSee('Inner City')
            ->assertSee('I82much')
            ->assertSee('38.64')
            ->assertSee('Mazda Miata MX-5')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_port_royal()
    {
        $this->get('server/best-performers/circuit/1007')
            ->assertSee('Port Royal')
            ->assertSee('I82much')
            ->assertSee('39.09')
            ->assertSee('Mazda Miata MX-5')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_national_rail()
    {
        $this->get('server/best-performers/circuit/1008')
            ->assertSee('Port Royal')
            ->assertSee('I82much')
            ->assertSee('38.19')
            ->assertSee('Mazda Miata MX-5')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_liberty_gardens()
    {
        $this->get('server/best-performers/sprint/1102')
            ->assertSee('Liberty Gardens')
            ->assertSee('samurai')
            ->assertSee('1:25.51')
            ->assertSee('Mazda RX-7')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_broadway()
    {
        $this->get('server/best-performers/sprint/1103')
            ->assertSee('Broadway')
            ->assertSee('Ron123')
            ->assertSee('2:19.86')
            ->assertSee('Toyota Supra')
            ->assertSee('reverse');
    }

    /** @test */
    function it_shows_the_lock_up()
    {
        $this->get('server/best-performers/sprint/1104')
            ->assertSee('Lock Up')
            ->assertSee('Ron123')
            ->assertSee('2:38.01')
            ->assertSee('Toyota Supra')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_9th_frey()
    {
        $this->get('server/best-performers/sprint/1105')
            ->assertSee('9th Frey')
            ->assertSee('Ron123')
            ->assertSee('2:25.67')
            ->assertSee('Toyota Supra')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_bedard_bridge()
    {
        $this->get('server/best-performers/sprint/1106')
            ->assertSee('Bedard Bridge')
            ->assertSee('Interpolytor')
            ->assertSee('2:10.25')
            ->assertSee('Mazda RX-7')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_spillway()
    {
        $this->get('server/best-performers/sprint/1107')
            ->assertSee('Spillway')
            ->assertSee('Interpolytor')
            ->assertSee('2:48.36')
            ->assertSee('Mazda RX-7')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_1st_ave_truck_stop()
    {
        $this->get('server/best-performers/sprint/1108')
            ->assertSee('1st Ave. Truck Stop')
            ->assertSee('Interpolytor')
            ->assertSee('2:03.43')
            ->assertSee('Mazda RX-7')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_7th_sparling()
    {
        $this->get('server/best-performers/sprint/1109')
            ->assertSee('7th Sparling')
            ->assertSee('agressor94')
            ->assertSee('1:46.62')
            ->assertSee('Acura RSX')
            ->assertSee('reverse');
    }

    /** @test */
    function it_shows_the_14th_and_vine_construction()
    {
        $this->get('server/best-performers/drag/1201')
            ->assertSee('14th and Vine Construction')
            ->assertSee('fancy')
            ->assertSee('18.79')
            ->assertSee('Mazda RX-7')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_highway_1()
    {
        $this->get('server/best-performers/drag/1202')
            ->assertSee('Highway 1')
            ->assertSee('fancy')
            ->assertSee('18.94')
            ->assertSee('Mazda RX-7')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_main_street()
    {
        $this->get('server/best-performers/drag/1206')
            ->assertSee('Main Street')
            ->assertSee('fancy')
            ->assertSee('19.36')
            ->assertSee('Mazda RX-7')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_commercial()
    {
        $this->get('server/best-performers/drag/1207')
            ->assertSee('Commercial')
            ->assertSee('fancy')
            ->assertSee('19.89')
            ->assertSee('Mazda RX-7')
            ->assertSee('reverse');
    }

    /** @test */
    function it_shows_the_14th_and_vine()
    {
        $this->get('server/best-performers/drag/1210')
            ->assertSee('14th and Vine')
            ->assertSee('MasterrRX7')
            ->assertSee('18.68')
            ->assertSee('Mazda RX-7')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_main_street_construction()
    {
        $this->get('server/best-performers/drag/1214')
            ->assertSee('Main Street Construction')
            ->assertSee('TheRo')
            ->assertSee('20.64')
            ->assertSee('Mazda RX-7')
            ->assertSee('forward');
    }


    /** @test */
    function it_shows_the_drift_track_1()
    {
        $this->get('server/best-performers/drift/1301')
            ->assertSee('Drift Track 1')
            ->assertSee('LSDxALEX')
            ->assertSee('125 081')
            ->assertSee('Acura Integra TypeR')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_drift_track_2()
    {
        $this->get('server/best-performers/drift/1302')
            ->assertSee('Drift Track 2')
            ->assertSee('Izzibaew')
            ->assertSee('35 061')
            ->assertSee('Mitsubishi Lancer')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_drift_track_3()
    {
        $this->withoutExceptionHandling();
        $this->get('server/best-performers/drift/1303')
            ->assertSee('Drift Track 3')
            ->assertSee('Izzibaew')
            ->assertSee('17 596')
            ->assertSee('Mitsubishi Lancer')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_drift_track_4()
    {
        $this->withoutExceptionHandling();
        $this->get('server/best-performers/drift/1304')
            ->assertSee('Drift Track 4')
            ->assertSee('LSDxALEX')
            ->assertSee('365 445')
            ->assertSee('Acura Integra TypeR')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_drift_track_5()
    {
        $this->withoutExceptionHandling();
        $this->get('server/best-performers/drift/1305')
            ->assertSee('Drift Track 5')
            ->assertSee('LSDxALEX')
            ->assertSee('216 591')
            ->assertSee('Acura Integra TypeR')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_drift_track_6()
    {
        $this->withoutExceptionHandling();
        $this->get('server/best-performers/drift/1306')
            ->assertSee('Drift Track 6')
            ->assertSee('8man')
            ->assertSee('183 999')
            ->assertSee('Subaru Impreza')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_drift_track_7()
    {
        $this->withoutExceptionHandling();
        $this->get('server/best-performers/drift/1307')
            ->assertSee('Drift Track 7')
            ->assertSee('LSDxALEX')
            ->assertSee('530 916')
            ->assertSee('Acura Integra TypeR')
            ->assertSee('forward');
    }

    /** @test */
    function it_shows_the_drift_track_8()
    {
        $this->withoutExceptionHandling();
        $this->get('server/best-performers/drift/1308')
            ->assertSee('Drift Track 8')
            ->assertSee('Ilia')
            ->assertSee('61 968')
            ->assertSee('Mazda RX-7')
            ->assertSee('forward');
    }
}
