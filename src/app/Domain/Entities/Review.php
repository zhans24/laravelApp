<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\Rating;

class Review
{
    private int $id;
    private int $productId;

    public function __construct(
        private Rating $rating,
        private string $text,
        private string $userName,
        int $productId
    ) {
        $this->productId = $productId;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRating(): Rating
    {
        return $this->rating;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }
}
