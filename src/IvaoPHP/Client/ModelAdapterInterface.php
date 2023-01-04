<?php


namespace IvaoPHP\Client;


interface ModelAdapterInterface
{
    public function getData(): array;
    public function setData(array $data);
    public function transform();
}