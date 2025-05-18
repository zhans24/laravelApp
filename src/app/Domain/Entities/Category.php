<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\CategoryName;

class Category
{
    private ?int $id = null;

    public function __construct(
        private CategoryName $name
    ) {}

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): CategoryName
    {
        return $this->name;
    }
}
