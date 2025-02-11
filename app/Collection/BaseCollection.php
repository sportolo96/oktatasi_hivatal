<?php

declare(strict_types=1);

namespace App\Collection;

abstract class BaseCollection implements \Countable, \IteratorAggregate
{
    protected array $values = [];

    public function toArray(): array
    {
        return $this->values;
    }

    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->values);
    }

    public function getValues(): array
    {
        return array_values($this->values);
    }

    public function count(): int
    {
        return \count($this->values);
    }

    public function add($element): void
    {
        $this->values[] = $element;
    }
}
