<?php

declare(strict_types=1);

namespace App\Domain\Side;

use ArrayObject;
use InvalidArgumentException;

class SideCollection extends ArrayObject
{
    public function __construct(array $items = [])
    {
        parent::__construct($items);
        foreach ($items as $item) {
            $this->validate($item);
        }
    }

    public function append($value): void
    {
        $this->validate($value);
        parent::append($value);
    }

    public function offsetSet($key, $value): void
    {
        $this->validate($value);
        parent::offsetSet($key, $value);
    }

    protected function validate($value): void
    {
        if (!$value instanceof Side) {
            throw new InvalidArgumentException(
                'Not an instance of Side'
            );
        }
    }
}