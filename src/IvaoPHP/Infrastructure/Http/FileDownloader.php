<?php

namespace IvaoPHP\Infrastructure\Http;

use IvaoPHP\Whazzup\Http\HttpFileDownloaderInterface;

class FileDownloader implements HttpFileDownloaderInterface
{
    public function download(string $url): string
    {
        return file_get_contents($url);
    }
}