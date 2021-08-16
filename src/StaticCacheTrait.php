<?php

declare(strict_types=1);

use function array_key_exists;

trait StaticCacheTrait // phpcs:ignore
{
    /** @var array<string, array<string, mixed>> */
    private static $staticCacheMap = [];

    abstract public function cacheName(): string;

    /**
     * @return mixed
     */
    public function getStaticCache(string $itemKey)
    {
        $cacheName = $this->cacheName();
        if (! array_key_exists($cacheName, self::$staticCacheMap) ||
            ! array_key_exists($itemKey, self::$staticCacheMap[$cacheName])) {
            return null;
        }

        return self::$staticCacheMap[$cacheName][$itemKey];
    }

    /**
     * @param mixed $object
     */
    public function setStaticCache(string $itemKey, $object): void
    {
        self::$staticCacheMap[$this->cacheName()][$itemKey] = $object;
    }
}
