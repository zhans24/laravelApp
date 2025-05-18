<?php

namespace App\Application\DTO\Output;

use App\Domain\Entities\Review;

class ReviewOutputDTO
{
    public int $id;
    public int $productId;
    public string $userName;
    public string $text;
    public int $rating;
    public string $createdAt;

    public function __construct(int $id, int $productId, string $userName, string $text, int $rating, string $createdAt)
    {
        $this->id = $id;
        $this->productId = $productId;
        $this->userName = $userName;
        $this->text = $text;
        $this->rating = $rating;
        $this->createdAt = $createdAt;
    }

    public static function fromEntity(Review $review): self
    {
        return new self(
            $review->getId(),
            $review->getProductId(),
            $review->getUserName(),
            $review->getText(),
            $review->getRating()->value(),
            $review->getCreatedAt()->format('Y-m-d H:i:s')
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'productId' => $this->productId,
            'userName' => $this->userName,
            'text' => $this->text,
            'rating' => $this->rating,
            'created_at' => $this->createdAt,
        ];
    }
}
