<?php


namespace IvaoPHP\Whazzup;


use IvaoPHP\Infrastructure\Cache\WhazzupFileCacher;
use IvaoPHP\Whazzup\Dto\Connections;
use IvaoPHP\Whazzup\Dto\Whazzup;
use IvaoPHP\Whazzup\Http\WhazzupFileDownloader;

class IvaoClient
{
    private ?Whazzup $whazzup = null;
    private WhazzupFileDownloader $fileDownloader;
    private WhazzupFileCacher $fileCacher;

    public function __construct(WhazzupFileDownloader $fileDownloader, WhazzupFileCacher $fileCacher)
    {
        $this->fileDownloader = $fileDownloader;
        $this->fileCacher = $fileCacher;
    }

    public function getData(): array
    {

        if ($cachedWhazzup = $this->fileCacher->getWhazzupFromCache())
        {
            return $cachedWhazzup->getResponseData();
        }

        if ($this->whazzup === null) {
            $this->whazzup = new Whazzup($this->fileDownloader->getScalarResponseData());
            $this->fileCacher->setWhazzupCache($this->whazzup);
        }

        return $this->whazzup->getResponseData();
    }

    /**
     * temp method for tests purposes
     */
    public function getTotalConnections(): int
    {
        return $this->getData()[Whazzup::CONNECTIONS][Connections::TOTAL];
    }
}