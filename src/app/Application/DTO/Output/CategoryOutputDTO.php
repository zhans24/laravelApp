<?php

namespace App\Application\DTO\Output;

use App\Domain\Entities\Category;

class CategoryOutputDTO
{
    public int $id;
    public string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public static function fromEntity(Category $category): self
    {
        return new self(
            $category->getId(),
            $category->getName()->value()
        );
    }
}
