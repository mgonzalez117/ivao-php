<?php


namespace IvaoPHP\Client;

use IvaoPHP\Client\Airport\AirportInterface;

interface IvaoClientInterface
{
    public function getAirport() :AirportInterface;
}