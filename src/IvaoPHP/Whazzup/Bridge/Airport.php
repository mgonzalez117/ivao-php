<?php


namespace IvaoPHP\Whazzup\Bridge;


use IvaoPHP\Whazzup\Bridge\Dto\Clients;
use IvaoPHP\Whazzup\Bridge\Dto\FlightPlan;
use IvaoPHP\Whazzup\Bridge\Dto\Pilot;
use IvaoPHP\Whazzup\Bridge\Dto\Whazzup;

class Airport
{
    private array $whazzupData;

    public function __construct(array $whazzupData)
    {
        $this->whazzupData = $whazzupData;
    }

    public function getTrafic(string $airportICAO)
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