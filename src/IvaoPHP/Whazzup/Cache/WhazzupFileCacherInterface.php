<?php


namespace IvaoPHP\Whazzup\Cache;


use IvaoPHP\Whazzup\Dto\Whazzup;

interface WhazzupFileCacherInterface
{
    public function getWhazzupFromCache(): ?Whazzup;
    public function setWhazzupCache(Whazzup $whazzup, int $ttl): bool;
    public function clearCache(): bool;
}