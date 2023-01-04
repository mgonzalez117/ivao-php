<?php


namespace IvaoPHP\Client\Airport\Dto;


class AirportTrafficsDto
{
    /**
     * @var array<AirportTrafficDto>
     */
    private array $inbound;

    /**
     * @var array<AirportTrafficDto>
     */
    private array $outbound;

    /**
     * @return AirportTrafficDto[]
     */
    public function getInbound(): array
    {
        return $this->inbound;
    }

    /**
     * @param AirportTrafficDto[] $inbound
     */
    public function setInbound(array $inbound): void
    {
        $this->inbound = $inbound;
    }

    /**
     * @return AirportTrafficDto[]
     */
    public function getOutbound(): array
    {
        return $this->outbound;
    }

    /**
     * @param AirportTrafficDto[] $outbound
     */
    public function setOutbound(array $outbound): void
    {
        $this->outbound = $outbound;
    }
}