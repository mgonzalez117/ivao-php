<?php

declare(strict_types=1);

namespace IvaoPHP\Tests\Whazzup\Bridge\Http;


use PHPUnit\Framework\TestCase;
use IvaoPHP\Whazzup\Bridge\Http\WhazzupFileDownloader;
use IvaoPHP\Whazzup\Bridge\Dto\Clients;
use IvaoPHP\Whazzup\Bridge\Dto\Whazzup;
use IvaoPHP\Whazzup\Bridge\Dto\Connections;

class WhazzupFileDownloaderTest extends TestCase
{
    private WhazzupFileDownloader $whazzupFileDownloader;

    public function setUp(): void
    {
        parent::setUp();
        $this->whazzupFileDownloader = new WhazzupFileDownloader(new HttpFileDownloaderMock());
    }

    /**
     * @covers \IvaoPHP\Whazzup\Bridge\Http\WhazzupFileDownloader::getScalarResponseData
     */
    public function testGetScalarData()
    {
        $data = $this->whazzupFileDownloader->getScalarResponseData();

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