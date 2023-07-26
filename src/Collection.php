<?php

namespace Createlinux\Routing;

class Collection implements \ArrayAccess
{

    protected array $items = [];

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->items[$offset]);
    }

    public function offsetGet(mixed $offset): mixed
    {
        return $this->items[$offset] ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->items[$offset] = $value;
    }

    public function offsetUnset(mixed $offset): void
    {
        unset($this->items[$offset]);
    }

    public function toArray()
    {
        return $this->items;
    }

    public function map(callable $callback)
    {

        foreach ($this->items as $routerAlias => $item){
            $callback($item);
        }
    }
}
