<?php

namespace App\Application\DTO\Input;

use Illuminate\Http\Request;

class CreateCategoryInputDTO
{
    public string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public static function fromRequest(Request $request): self
    {
        return new self($request->input('name'));
    }
}
