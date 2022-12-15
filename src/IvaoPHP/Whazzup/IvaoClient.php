<?php


namespace IvaoPHP\Whazzup;


use IvaoPHP\Whazzup\Dto\Connections;
use IvaoPHP\Whazzup\Dto\Whazzup;
use IvaoPHP\Whazzup\Http\WhazzupFileDownloader;

class IvaoClient
{
    private WhazzupFileDownloader $fileDownloader;

    public function __construct(WhazzupFileDownloader $fileDownloader)
    {
        $this->fileDownloader = $fileDownloader;
    }

    /**
     * temp method for tests purposes
     */
    public function getTotalConnections(): int
    {
        return $this->fileDownloader->getScalarData()[Whazzup::CONNECTIONS][Connections::TOTAL];
    }
}