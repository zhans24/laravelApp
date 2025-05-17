<?php

namespace App\Domain\ValueObjects;

class Rating
{
    private int $value;

    public function __construct(int $value)
    {
        if ($value < 1 || $value > 5) {
            throw new \InvalidArgumentException('Rating must be between 1 and 5.');
        }
        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }
}
