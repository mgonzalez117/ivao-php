<?php


namespace IvaoPHP\Whazzup\Airport\Adapter;


use IvaoPHP\Client\Airport\Dto\AirportTrafficDto;
use IvaoPHP\Client\Airport\Dto\AirportTrafficsDto;
use IvaoPHP\Client\ModelAdapterInterface;
use IvaoPHP\Whazzup\Dto\Pilot;

class TraficModelAdapter implements ModelAdapterInterface
{
    private array $data;

    public function __construct(array $data)
    {
        $this->setData($data);
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data)
    {
        $this->data = $data;
        return $this;
    }

    public function transform()
    {
        $traffics = new AirportTrafficsDto();

        $inbounds = array_map(function($item) {
            return $this->transformItem($item);
        }, $this->getData()['inbounds']);

        $outbounds = array_map(function($item) {
            return $this->transformItem($item);
        }, $this->getData()['outbounds']);

        $traffics->setInbound($inbounds);
        $traffics->setOutbound($outbounds);

        return $traffics;
    }

    private function transformItem(array $rawItem)
    {
        $traffic = new AirportTrafficDto();
        $traffic->setId(intval($rawItem[Pilot::ID]));
        $traffic->setCallsign($rawItem[Pilot::CALLSIGN]);
        $traffic->setUserId(intval($rawItem[Pilot::USER_ID]));
        $traffic->setServerId($rawItem[Pilot::SERVER_ID]);
        $traffic->setCreatedAt(\DateTime::createFromFormat('Y-m-d\TH:i:s.u\Z', $rawItem[Pilot::CREATED_AT]));

        return $traffic;
    }
}