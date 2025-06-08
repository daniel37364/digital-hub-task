<?php

declare(strict_types=1);

namespace Modules\LabTest\Domain\Collections;

use Modules\LabTest\Domain\Models\LabTest;
use ArrayIterator;
use IteratorAggregate;
use Countable;

class LabTestCollection implements IteratorAggregate, Countable
{
    private array $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function add(LabTest $item): void
    {
        $this->items[] = $item;
    }

    public function getIterator(): ArrayIterator
    {
        return new ArrayIterator($this->items);
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function toArray(): array
    {
        return $this->items;
    }
}
