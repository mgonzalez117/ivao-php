<?php

namespace IvaoPHP\Client\Airport\Dto;

class AirportTrafficDto
{
    private int $id;
    private string $callsign;
    private int $userId;
    private string $serverId;
    private \DateTime $createdAt;
    private int $time;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCallsign(): string
    {
        return $this->callsign;
    }

    public function setCallsign(string $callsign): void
    {
        $this->callsign = $callsign;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getConnectionType(): string
    {
        return $this->connectionType;
    }

    public function setConnectionType(string $connectionType): void
    {
        $this->connectionType = $connectionType;
    }

    public function getServerId(): string
    {
        return $this->serverId;
    }

    public function setServerId(string $serverId): void
    {
        $this->serverId = $serverId;
    }

    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getTime(): int
    {
        return $this->time;
    }

    public function setTime(int $time): void
    {
        $this->time = $time;
    }
}