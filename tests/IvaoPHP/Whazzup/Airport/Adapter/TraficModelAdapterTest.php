<?php


namespace IvaoPHP\Whazzup\Airport\Adapter;


use IvaoPHP\Client\Airport\Dto\AirportTrafficsDto;
use IvaoPHP\Client\Airport\Dto\AirportTrafficDto;
use IvaoPHP\Tests\Whazzup\WhazzupClientMock;
use PHPUnit\Framework\TestCase;

class TraficModelAdapterTest extends TestCase
{
    /**
     * @covers \IvaoPHP\Whazzup\Airport\Adapter\TraficModelAdapter::transform
     */
    public function testTransform()
    {
        $whazzupClient = WhazzupClientMock::create();

        $adapter = new TraficModelAdapter(
            $whazzupClient->getAirport()->getTraffic('LFMN')
        );

        $trafficModel = $adapter->transform();

        $this->assertInstanceOf(AirportTrafficsDto::class, $trafficModel);
        $this->assertIsArray($trafficModel->getInbound());
        $this->assertIsArray($trafficModel->getOutbound());

        $this->assertInstanceOf(AirportTrafficDto::class, $trafficModel->getInbound()[0]);
        $this->assertInstanceOf(AirportTrafficDto::class, $trafficModel->getOutbound()[0]);
    }
}