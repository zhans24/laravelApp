<?php

namespace App\Application\DTO\Output;

use App\Domain\Entities\Product;

class ProductOutputDTO
{
    public function __construct(
        public readonly int $id,
        public readonly string $code,
        public readonly string $name,
        public readonly ?string $description,
        public readonly float $price,
        public readonly float $discount,
        public readonly ?string $photo,
        public readonly int $categoryId
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

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'discount' => $this->discount,
            'photo' => $this->photo,
            'categoryId' => $this->categoryId,
        ];
    }
}
