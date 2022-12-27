<?php


namespace IvaoPHP\Tests\Whazzup;
use IvaoPHP\Shared\Infrastructure\Cache\WhazzupFileCacher;
use IvaoPHP\Tests\Whazzup\Http\HttpFileDownloaderMock;
use IvaoPHP\Whazzup\Http\WhazzupFileDownloader;
use IvaoPHP\Whazzup\IvaoClient;
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
     * @covers \IvaoPHP\Whazzup\IvaoClient::getTotalConnections
     */
    public function testGetConnections()
    {
        $this->assertEquals(505, $this->ivaoClient->getTotalConnections());
    }
}