<?php

namespace App\Domain\ValueObjects;

use InvalidArgumentException;

class CategoryName
{
    private string $value;
    public function __construct(string $value)
    {
        if (empty($value) or strlen($value) > 100) {
            throw new InvalidArgumentException('EloquentCategory name must be non-empty and less than 100 characters.');
        }

        $this->value=$value;
    }

    public function value() : string
    {
        return $this->value;
    }
}
