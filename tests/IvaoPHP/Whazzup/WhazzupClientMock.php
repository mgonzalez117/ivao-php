<?php


namespace IvaoPHP\Tests\Whazzup;


use IvaoPHP\Shared\Infrastructure\Cache\WhazzupFileCacher;
use IvaoPHP\Tests\Whazzup\Http\HttpFileDownloaderMock;
use IvaoPHP\Whazzup\Http\WhazzupFileDownloader;
use IvaoPHP\Whazzup\WhazzupClient;

class WhazzupClientMock
{
    public static function create(): WhazzupClient
    {
        $whazzupFileDownloader = new WhazzupFileDownloader(new HttpFileDownloaderMock());
        return new WhazzupClient($whazzupFileDownloader, new WhazzupFileCacher());
    }
}