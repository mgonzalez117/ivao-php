<?php


namespace IvaoPHP\Tests\Whazzup\Bridge;
use IvaoPHP\Shared\Infrastructure\Cache\WhazzupFileCacher;
use IvaoPHP\Tests\Whazzup\Bridge\Http\HttpFileDownloaderMock;
use IvaoPHP\Whazzup\Bridge\Dto\FlightPlan;
use IvaoPHP\Whazzup\Bridge\Dto\Pilot;
use IvaoPHP\Whazzup\Bridge\Http\WhazzupFileDownloader;
use IvaoPHP\Whazzup\Bridge\IvaoClient;
use PHPUnit\Framework\TestCase;


class IvaoClientTest extends TestCase
{
    private IvaoClient $ivaoClient;

    public function setUp():void
    {
        $whazzupFileDownloader = new WhazzupFileDownloader(new HttpFileDownloaderMock());
        $this->ivaoClient = new IvaoClient($whazzupFileDownloader, new WhazzupFileCacher());
    }

    /**
     * @covers \IvaoPHP\Whazzup\Bridge\IvaoClient::getTotalConnections
     */
    public function testGetConnections()
    {
        $this->assertEquals(505, $this->ivaoClient->getTotalConnections());
    }

    /**
     * @covers \IvaoPHP\Whazzup\Bridge\IvaoClient::getAirportTrafic
     */
    public function testGetAirportTrafic()
    {
        $airportICAO = 'LFMN';

        $trafic = $this->ivaoClient->getAirport()->getTrafic($airportICAO);

        $this->assertIsArray($trafic);
        $this->assertArrayHasKey('inbounds', $trafic);
        $this->assertArrayHasKey('outbounds', $trafic);

        $this->assertEquals(1, count($trafic['inbounds']));
        $this->assertEquals(2, count($trafic['outbounds']));

        $this->assertEquals($airportICAO, $trafic['inbounds'][0][Pilot::FLIGHTPLAN][FlightPlan::ARRIVAL_ID]);

        $this->assertEquals($airportICAO, $trafic['outbounds'][0][Pilot::FLIGHTPLAN][FlightPlan::DEPARTURE_ID]);
        $this->assertEquals($airportICAO, $trafic['outbounds'][1][Pilot::FLIGHTPLAN][FlightPlan::DEPARTURE_ID]);
    }
}