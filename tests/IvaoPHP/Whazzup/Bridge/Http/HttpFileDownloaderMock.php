<?php

namespace IvaoPHP\Tests\Whazzup\Bridge\Http;


use IvaoPHP\Whazzup\Bridge\Http\HttpFileDownloaderInterface;

class HttpFileDownloaderMock implements HttpFileDownloaderInterface
{
    public function download(?string $url = ''): string
    {
        return file_get_contents(__DIR__ . '/../../../../Fixtures/whazzup.json');
    }
}