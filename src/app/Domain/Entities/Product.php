<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\ProductCode;
use App\Domain\ValueObjects\Price;

class Product
{
    private int $id;

    public function __construct(
        private ProductCode $code,
        private string $name,
        private ?string $description,
        private Price $price,
        private Price $discount,
        private ?string $photo,
        private int $categoryId
    ) {}

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCode(): ProductCode
    {
        return $this->code;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getPrice(): Price
    {
        return $this->price;
    }

    public function getDiscount(): Price
    {
        return $this->discount;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }
}
