<?php

namespace IvaoPHP\Whazzup\Http;

interface HttpFileDownloaderInterface
{
    public function download(string $url): string;
}