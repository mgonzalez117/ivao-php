<?php


namespace IvaoPHP\Whazzup\Bridge\Http;


class WhazzupFileDownloader
{
    private string $fileUrl;
    private HttpFileDownloaderInterface $fileDownloader;

    public function __construct(HttpFileDownloaderInterface $fileDownloader, string $fileUrl = 'https://api.ivao.aero/v2/tracker/whazzup')
    {
        $this->fileUrl = $fileUrl;
        $this->fileDownloader = $fileDownloader;
    }

    public function getScalarResponseData(): array
    {
        return json_decode($this->download(), true);
    }

    private function download()
    {
        return $this->fileDownloader->download($this->fileUrl);
    }
}