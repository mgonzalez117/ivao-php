<?php

declare(strict_types=1);

namespace IvaoPHP\Tests\Whazzup\Http;


use PHPUnit\Framework\TestCase;
use IvaoPHP\Tests\Whazzup\Http\HttpFileDownloaderMock;
use IvaoPHP\Whazzup\Http\WhazzupClient;
use IvaoPHP\Whazzup\Dto\Clients;
use IvaoPHP\Whazzup\Dto\Whazzup;
use IvaoPHP\Whazzup\Dto\Connections;

class WhazzupClientTest extends TestCase
{
    private WhazzupClient $whazzupClient;

    public function setUp(): void
    {
        parent::setUp();
        $this->whazzupClient = new WhazzupClient(new HttpFileDownloaderMock());
    }

    /**
     * @covers \IvaoPHP\Whazzup\Http\WhazzupClient::getScalarData
     */
    public function testGetScalarData()
    {
        $data = $this->whazzupClient->getScalarData();

        $this->assertIsArray($data);
        $this->assertArrayHasKey(Whazzup::UPDATED_AT, $data);
        $this->assertArrayHasKey(Whazzup::SERVERS, $data);
        $this->assertArrayHasKey(Whazzup::CLIENTS, $data);
        $this->assertArrayHasKey(Whazzup::VOICE_SERVERS, $data);
        $this->assertArrayHasKey(Whazzup::CONNECTIONS, $data);

        $clients = $data[Whazzup::CLIENTS];
        $this->assertArrayHasKey(Clients::PILOTS, $clients);
        $this->assertArrayHasKey(Clients::ATC, $clients);

        $connections = $data[Whazzup::CONNECTIONS];
        $this->assertArrayHasKey(Connections::PILOT, $connections);
        $this->assertArrayHasKey(Connections::ATC, $connections);

        $this->assertEquals(505, $connections[Connections::TOTAL]);
        $this->assertEquals(445, $connections[Connections::PILOT]);
        $this->assertEquals(49, $connections[Connections::ATC]);
    }
}