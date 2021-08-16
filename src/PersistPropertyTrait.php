<?php

declare(strict_types=1);

use function md5;
use function serialize;

trait PersistPropertyTrait
{
    /** @var string|null */
    private $objectHash;

    /** @var bool */
    private $persisted = false;

    /** @var bool */
    private $removal = false;

    private function getPureObject(): self
    {
        $object = clone $this;
        $object->objectHash = null;
        $object->persisted = null;
        $object->removal = null;

        return $object;
    }

    protected function setObjectHash(): void
    {
        $object = $this->getPureObject();
        $this->objectHash = md5(serialize($object));
    }

    public function isPropertyChanged(): bool
    {
        $object = $this->getPureObject();
        return $this->objectHash !== md5(serialize($object));
    }

    protected function setPersisted(): void
    {
        $this->persisted = true;
    }

    public function isPersisted(): bool
    {
        return $this->persisted;
    }

    public function isRemoval(): bool
    {
        return $this->removal;
    }

    public function setRemoval(bool $removal): void
    {
        $this->removal = $removal;
    }
}
