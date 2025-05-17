<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\CategoryName;


class Category
{
    private int $id;
    private CategoryName $name;

    public function __construct(CategoryName $name)
    {
        $this->name = $name;
    }

    public function getId(): int
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
