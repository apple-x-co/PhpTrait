<?php

declare(strict_types=1);

use function array_key_exists;

trait MemoryCacheTrait // phpcs:ignore
{
    /** @var array<string, array<string, mixed>> */
    private static $cacheMap = [];

    abstract public function cacheName(): string;

    /**
     * @return mixed
     */
    public function getMemoryCache(string $itemName)
    {
        $cacheName = $this->cacheName();
        if (! array_key_exists($cacheName, self::$cacheMap) ||
            ! array_key_exists($itemName, self::$cacheMap[$cacheName])) {
            return null;
        }

        return self::$cacheMap[$cacheName][$itemName];
    }

    /**
     * @param mixed $object
     */
    public function setMemoryCache(string $itemName, $object): void
    {
        self::$cacheMap[$this->cacheName()][$itemName] = $object;
    }
}
