<?php


namespace IvaoPHP\Shared\Infrastructure\Cache;


use IvaoPHP\Whazzup\Cache\WhazzupFileCacherInterface;
use IvaoPHP\Whazzup\Dto\Whazzup;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\CacheItem;

class WhazzupFileCacher implements WhazzupFileCacherInterface
{
    private FilesystemAdapter $filesystemAdapter;

    const WHAZZUP_KEY = 'whazzup';

    public function __construct()
    {
        $this->filesystemAdapter = new FilesystemAdapter();
    }

    public function getWhazzupFromCache(): ?Whazzup
    {
       return $this->filesystemAdapter->getItem(self::WHAZZUP_KEY)->get();
    }

    public function setWhazzupCache(Whazzup $whazzup, int $ttl = 60): bool
    {
        $cacheItem = $this->filesystemAdapter->getItem(self::WHAZZUP_KEY);
        $cacheItem->expiresAfter($ttl);
        $cacheItem->set($whazzup);
        return $this->filesystemAdapter->save($cacheItem);
    }

    public function clearCache(): bool
    {
        return $this->filesystemAdapter->clear();
    }
}