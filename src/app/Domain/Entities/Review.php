<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\Rating;

class Review
{
    private int $id;
    private int $productId;
    private string $userName;
    private string $text;
    private Rating $rating;

    public function __construct(
        int $productId,
        string $userName,
        string $text,
        Rating $rating
    ) {
        $this->productId = $productId;
        $this->userName = $userName;
        $this->text = $text;
        $this->rating = $rating;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getRating(): Rating
    {
        return $this->rating;
    }
}
