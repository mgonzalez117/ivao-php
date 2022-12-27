<?php

namespace IvaoPHP\Whazzup\Bridge\Http;

interface HttpFileDownloaderInterface
{
    public function download(string $url): string;
}