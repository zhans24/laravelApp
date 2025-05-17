<?php

namespace App\Domain\ValueObjects;

use InvalidArgumentException;

class Rating
{
    private int $value;

    public function __construct(int $value)
    {
        if ($value < 1 or $value > 5) {
            throw new InvalidArgumentException('Rating must be between 1 and 5');
        }
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
}
