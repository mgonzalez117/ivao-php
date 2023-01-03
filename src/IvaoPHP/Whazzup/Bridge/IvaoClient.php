<?php


namespace IvaoPHP\Whazzup\Bridge;


use IvaoPHP\Shared\Infrastructure\Cache\WhazzupFileCacher;
use IvaoPHP\Whazzup\Bridge\Dto\Clients;
use IvaoPHP\Whazzup\Bridge\Dto\Connections;
use IvaoPHP\Whazzup\Bridge\Dto\Pilot;
use IvaoPHP\Whazzup\Bridge\Dto\FlightPlan;
use IvaoPHP\Whazzup\Bridge\Dto\Whazzup;
use IvaoPHP\Whazzup\Bridge\Http\WhazzupFileDownloader;

class IvaoClient
{
    private ?Whazzup $whazzup = null;
    private WhazzupFileDownloader $fileDownloader;
    private WhazzupFileCacher $fileCacher;

    private ?Airport $airport = null;

    public function __construct(WhazzupFileDownloader $fileDownloader, WhazzupFileCacher $fileCacher)
    {
        $this->fileDownloader = $fileDownloader;
        $this->fileCacher = $fileCacher;
    }

    /**
     * https://wiki.ivao.aero/en/home/devops/api/whazuup/how-to-retrieve-v2
     * Uses the cache because => The whazzup file may only be downloaded once every 15 seconds, which means 4 times during one minute. Using a more frequent download rate will result in an IP ban.
     * @return array
     */
    private function getData(): array
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

    public function getAirport() :Airport
    {
        if ($this->airport !== null) {
            return $this->airport;
        }

        $this->airport = new Airport($this->getData());

        return $this->airport;
    }
}