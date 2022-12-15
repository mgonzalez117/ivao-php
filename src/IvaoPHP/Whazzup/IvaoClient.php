<?php


namespace IvaoPHP\Whazzup;


use IvaoPHP\Whazzup\Dto\Connections;
use IvaoPHP\Whazzup\Dto\Whazzup;
use IvaoPHP\Whazzup\Http\WhazzupFileDownloader;

class IvaoClient
{
    private ?Whazzup $whazzup = null;
    private WhazzupFileDownloader $fileDownloader;

    public function __construct(WhazzupFileDownloader $fileDownloader)
    {
        $this->fileDownloader = $fileDownloader;
    }

    public function getData(): array
    {
        // todo: cache management
        if ($this->whazzup === null) {
            $this->whazzup = new Whazzup($this->fileDownloader->getScalarResponseData());
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