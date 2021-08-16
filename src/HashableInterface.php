<?php

declare(strict_types=1);

interface HashableInterface
{
    public function equal(HashableInterface $hashable): bool;

    /**
     * @return string|int|bool
     */
    public function hashCode();
}
