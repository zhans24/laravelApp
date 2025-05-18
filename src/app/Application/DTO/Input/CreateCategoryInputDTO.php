<?php

namespace App\Application\DTO\Input;

use Illuminate\Http\Request;
use InvalidArgumentException;

class CreateCategoryInputDTO
{
    public function __construct(
        public readonly string $name
    ) {}

    public static function fromRequest(Request $request): self
    {
        $name = $request->input('name');

        if (empty($name) || strlen($name) > 100) {
            throw new InvalidArgumentException('Category name must be non-empty and less than 100 characters.');
        }

        return new self($name);
    }
}
