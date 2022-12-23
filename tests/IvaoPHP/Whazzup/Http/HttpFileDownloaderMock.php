<?php

namespace IvaoPHP\Tests\Whazzup\Http;


use IvaoPHP\Whazzup\Http\HttpFileDownloaderInterface;

class HttpFileDownloaderMock implements HttpFileDownloaderInterface
{
    public function download(?string $url = ''): string
    {
        return file_get_contents(__DIR__.'/../../../Fixtures/whazzup.json');
    }
}