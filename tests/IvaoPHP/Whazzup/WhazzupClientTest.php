<?php


namespace IvaoPHP\Tests\Whazzup;

use IvaoPHP\Whazzup\Dto\FlightPlan;
use IvaoPHP\Whazzup\Dto\Pilot;
use IvaoPHP\Whazzup\WhazzupClient;
use IvaoPHP\Tests\Whazzup\WhazzupClientMock;
use PHPUnit\Framework\TestCase;


class WhazzupClientTest extends TestCase
{
    private WhazzupClient $whazzupClient;

    public function setUp(): void
    {
        $this->whazzupClient = WhazzupClientMock::create();
    }

    /**
     * @covers \IvaoPHP\Whazzup\WhazzupClient::getTotalConnections
     */
    public function testGetConnections()
    {
        $this->assertEquals(505, $this->whazzupClient->getTotalConnections());
    }

    /**
     * @covers \IvaoPHP\Whazzup\WhazzupClient::getAirportTrafic
     */
    public function testGetAirportTrafic()
    {
        $airportICAO = 'LFMN';

        $traffic = $this->whazzupClient->getAirport()->getTraffic($airportICAO);

        $this->assertIsArray($traffic);
        $this->assertArrayHasKey('inbounds', $traffic);
        $this->assertArrayHasKey('outbounds', $traffic);

        $this->assertEquals(1, count($traffic['inbounds']));
        $this->assertEquals(2, count($traffic['outbounds']));

        $this->assertEquals($airportICAO, $traffic['inbounds'][0][Pilot::FLIGHTPLAN][FlightPlan::ARRIVAL_ID]);

        $this->assertEquals($airportICAO, $traffic['outbounds'][0][Pilot::FLIGHTPLAN][FlightPlan::DEPARTURE_ID]);
        $this->assertEquals($airportICAO, $traffic['outbounds'][1][Pilot::FLIGHTPLAN][FlightPlan::DEPARTURE_ID]);
    }
}