<?php

declare(strict_types=1);

trait ArrayAccessibleTrait
{
    /**
     * @param mixed $offset
     */
    public function offsetExists($offset): bool
    {
        return isset($this->$offset);
    }

    /**
     * @param mixed $offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->$offset ?? null;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value): void
    {
        if ($offset === null) {
            return;
        }

        $this->$offset = $value;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset): void
    {
        unset($this->$offset);
    }
}
