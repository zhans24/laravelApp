<?php

namespace App\Domain\Entities;

use App\Domain\ValueObjects\Rating;
use DateTime;

class Review
{
    private ?int $id = null;
    private int $productId;
    private ?DateTime $createdAt;

    public function __construct(
        private Rating $rating,
        private string $text,
        private string $userName,
        int $productId,
        ?DateTime $createdAt = null
    ) {
        $this->productId = $productId;
        $this->createdAt = $createdAt;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
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

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }
}
