<?php

namespace App\Domain\ValueObjects;

use InvalidArgumentException;

class ProductCode
{
    private string $code;

    public function __construct(string $code)
    {
        if (empty($code) || strlen($code) > 50) {
            throw new InvalidArgumentException('Product code must be non-empty and less than 50 characters.');
        }

        $this->code = $code;
    }

    public function value(): string
    {
        return $this->code;
    }
}
