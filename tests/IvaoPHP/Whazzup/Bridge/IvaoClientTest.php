<?php


namespace IvaoPHP\Tests\Whazzup\Bridge;
use IvaoPHP\Shared\Infrastructure\Cache\WhazzupFileCacher;
use IvaoPHP\Tests\Whazzup\Bridge\Http\HttpFileDownloaderMock;
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
}