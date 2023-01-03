<?php


namespace IvaoPHP\Whazzup\Bridge;


use IvaoPHP\Shared\Infrastructure\Cache\WhazzupFileCacher;
use IvaoPHP\Whazzup\Bridge\Dto\Clients;
use IvaoPHP\Whazzup\Bridge\Dto\Connections;
use IvaoPHP\Whazzup\Bridge\Dto\Whazzup;
use IvaoPHP\Whazzup\Bridge\Http\WhazzupFileDownloader;

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

    /**
     * https://wiki.ivao.aero/en/home/devops/api/whazuup/how-to-retrieve-v2
     * Uses the cache because => The whazzup file may only be downloaded once every 15 seconds, which means 4 times during one minute. Using a more frequent download rate will result in an IP ban.
     * @return array
     */
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

    public function getAirportTrafic(string $airportICAO)
    {
        $trafic = [
            'inbounds' => [],
            'outbounds' => []
        ];

        $pilots = array_filter($this->getData()[Whazzup::CLIENTS][Clients::PILOTS], function($item) use ($airportICAO) {
            if ($item['flightPlan']['departureId'] === $airportICAO || $item['flightPlan']['arrivalId'] === $airportICAO) {
                return true;
            }
        });

        foreach($pilots as $pilot) {
            if ($pilot['flightPlan']['departureId'] === $airportICAO) {
                $trafic['outbounds'][] = $pilot;
            }

            if($pilot['flightPlan']['arrivalId'] === $airportICAO) {
                $trafic['inbounds'][] = $pilot;
            }
        }

        return $trafic;
    }
}