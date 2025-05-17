<?php

namespace App\Application\DTO\Output;

use App\Domain\Entities\Product;
use App\Domain\Entities\Review;

class ProductWithReviewsOutputDTO
{
    public int $id;
    public string $code;
    public string $name;
    public ?string $description;
    public float $price;
    public float $discount;
    public ?string $photo;
    public int $categoryId;
    public array $reviews;

    public function __construct(
        int $id,
        string $code,
        string $name,
        ?string $description,
        float $price,
        float $discount,
        ?string $photo,
        int $categoryId,
        array $reviews
    ) {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->discount = $discount;
        $this->photo = $photo;
        $this->categoryId = $categoryId;
        $this->reviews = $reviews;
    }

    public static function fromEntity(Product $product, array $reviews): self
    {
        $reviewDTOs = array_map(
            fn(Review $review) => [
                'id' => $review->getId(),
                'user_name' => $review->getUserName(),
                'text' => $review->getText(),
                'rating' => $review->getRating()->value(),
            ],
            $reviews
        );

        return new self(
            $product->getId(),
            $product->getCode()->value(),
            $product->getName(),
            $product->getDescription(),
            $product->getPrice()->value(),
            $product->getDiscount()->value(),
            $product->getPhoto(),
            $product->getCategoryId(),
            $reviewDTOs
        );
    }
}
