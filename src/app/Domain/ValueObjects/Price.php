<?php

namespace App\Domain\ValueObjects;


use InvalidArgumentException;

class Price
{
    private float $value;

    public function __construct(float $value)
    {
        if ($value < 0) {
            throw new InvalidArgumentException('Price cannot be negative');
        }
        $this->value = $value;
    }

    public function value(): float
    {
        return $this->value;
    }
}
