<?php

declare(strict_types=1);

trait HashbleTrait
{
    /**
     * @return string|int|bool
     */
    abstract public function hashCode();

    public function equal(HashableInterface $hashable): bool
    {
        return $this->hashCode() === $hashable->hashCode();
    }
}
