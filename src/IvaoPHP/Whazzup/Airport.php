<?php


namespace IvaoPHP\Whazzup;


use IvaoPHP\Client\Airport\AirportInterface;
use IvaoPHP\Whazzup\Dto\Clients;
use IvaoPHP\Whazzup\Dto\FlightPlan;
use IvaoPHP\Whazzup\Dto\Pilot;
use IvaoPHP\Whazzup\Dto\Whazzup;

class Airport implements AirportInterface
{
    private array $whazzupData;

    public function __construct(array $whazzupData)
    {
        $this->whazzupData = $whazzupData;
    }

    public function getTraffic(string $airportICAO) :array
    {
        $trafic = [
            'inbounds' => [],
            'outbounds' => []
        ];

        $pilots = array_filter($this->whazzupData[Whazzup::CLIENTS][Clients::PILOTS], function($item) use ($airportICAO) {
            if ($item[Pilot::FLIGHTPLAN][FlightPlan::DEPARTURE_ID] === $airportICAO || $item[Pilot::FLIGHTPLAN][FlightPlan::ARRIVAL_ID] === $airportICAO) {
                return true;
            }
        });

        foreach($pilots as $pilot) {
            if ($pilot[Pilot::FLIGHTPLAN][FlightPlan::DEPARTURE_ID] === $airportICAO) {
                $trafic['outbounds'][] = $pilot;
            }

            if($pilot[Pilot::FLIGHTPLAN][FlightPlan::ARRIVAL_ID] === $airportICAO) {
                $trafic['inbounds'][] = $pilot;
            }
        }

        return $trafic;
    }
}