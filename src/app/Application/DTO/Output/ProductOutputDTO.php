<?php

namespace App\Application\DTO\Output;

class ProductOutputDTO
{
    public function __construct(
        public int $id,
        public string $code,
        public string $name,
        public ?string $description,
        public float $price,
        public float $discount,
        public ?string $photo,
        public int $categoryId,
    ) {}

    public static function fromEntity(Product $product): self
    {
        return new self(
            $product->getId(),
            $product->getCode()->value(),
            $product->getName(),
            $product->getDescription(),
            $product->getPrice()->value(),
            $product->getDiscount()->value(),
            $product->getPhoto(),
            $product->getCategoryId()
        );
    }
}
