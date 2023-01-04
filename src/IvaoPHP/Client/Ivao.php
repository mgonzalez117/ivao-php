<?php

namespace IvaoPHP\Client;

class Ivao
{
    private IvaoClientInterface $client;

    public function __construct(IvaoClientInterface $client)
    {
        $this->client = $client;
    }

    public function getClient(): IvaoClientInterface
    {
        return $this->client;
    }

    public function setClient(IvaoClientInterface $client): void
    {
        $this->client = $client;
    }
}