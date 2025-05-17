<?php

namespace App\Application\DTO\Output;

use App\Domain\Entities\Review;

class ReviewOutputDTO
{
    public function __construct(
        public int $id,
        public int $rating,
        public string $text,
        public string $userName,
        public int $productId
    ){}

    public static function fromEntity(Review $review): self
    {
        return new self(
            $review->getId(),
            $review->getRating()->value(),
            $review->getText(),
            $review->getUserName(),
            $review->getProductId()
        );
    }
}
