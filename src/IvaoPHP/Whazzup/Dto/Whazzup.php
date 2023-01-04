<?php

namespace IvaoPHP\Whazzup\Dto;

class Whazzup
{
    const UPDATED_AT = 'updatedAt';
    const SERVERS = 'servers';
    const VOICE_SERVERS = 'voiceServers';
    const CLIENTS = 'clients';
    const CONNECTIONS = 'connections';

    private array $responseData;

    public function __construct(?array $responseData)
    {
        $this->responseData = $responseData;
    }

    public function getResponseData(): array
    {
        return $this->responseData;
    }

    public function setResponseData(array $responseData): self
    {
        $this->responseData = $responseData;
        return $this;
    }
}