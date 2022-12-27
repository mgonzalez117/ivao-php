<?php


namespace IvaoPHP\Whazzup\Bridge\Cache;


use IvaoPHP\Whazzup\Bridge\Dto\Whazzup;

interface WhazzupFileCacherInterface
{
    public function getWhazzupFromCache(): ?Whazzup;
    public function setWhazzupCache(Whazzup $whazzup, int $ttl): bool;
    public function clearCache(): bool;
}