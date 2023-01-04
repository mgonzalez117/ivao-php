<?php


namespace IvaoPHP\Client\Airport;


interface AirportInterface
{
    public function getTraffic(string $airportICAO): array;
}