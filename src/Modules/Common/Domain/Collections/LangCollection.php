<?php

declare(strict_types=1);

namespace Modules\Common\Domain\Collections;

use Modules\Common\Domain\Models\Lang;
use ArrayIterator;
use IteratorAggregate;
use Countable;

class LangCollection implements IteratorAggregate, Countable
{
    private array $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    public function add(Lang $item): void
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

    public function has(string $langCode): bool
    {
        foreach ($this->items as $item) {
            if ($item->getCode() === $langCode) {
                return true;
            }
        }
        return false;
    }

    public function get(string $langCode): Lang
    {
        foreach ($this->items as $item) {
            if ($item->getCode() === $langCode) {
                return $item;
            }
        }
        throw new \InvalidArgumentException("Language code '$langCode' not found in LangCollection.");
    }
}
