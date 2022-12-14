<?php


namespace IvaoPHP\Whazzup\Http;


class WhazzupClient
{
    private string $fileUrl;

    public function __construct(string $fileUrl = 'https://api.ivao.aero/v2/tracker/whazzup')
    {
        $this->fileUrl = $fileUrl;
    }

    public function download(HttpFileDownloaderInterface $downloader)
    {
        $content = $downloader->download($this->fileUrl);
    }
}