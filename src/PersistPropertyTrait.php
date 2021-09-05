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

    public function objectInitialized(): void
    {
        $this->setObjectHash();
    }

    public function objectReconstruction(): void
    {
        $this->setPersisted();
        $this->setObjectHash();
    }

    public function isPropertyChanged(): bool
    {
        return $this->objectHash !== $this->makeHash($this->getPureObject());
    }

    public function isPersisted(): bool
    {
        return $this->persisted;
    }

    public function isRemoval(): bool
    {
        return $this->removal;
    }

    public function setRemoval(): void
    {
        $this->removal = true;
    }

    private function getPureObject(): self
    {
        $object = clone $this;
        $object->objectHash = null;
        $object->persisted = null;
        $object->removal = null;

        return $object;
    }

    private function setObjectHash(): void
    {
        $this->objectHash = $this->makeHash($this->getPureObject());
    }

    private function setPersisted(): void
    {
        $this->persisted = true;
    }

    private function makeHash($object): string
    {
        return md5(serialize($object));
    }
}
