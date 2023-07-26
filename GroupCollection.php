<?php

namespace routing;

class GroupCollection implements \ArrayAccess
{

    protected array $groups = [];

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->groups[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->groups[$offset] ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->groups[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->groups[$offset]);
    }
}
