<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Review;

interface ReviewRepositoryInterface
{
    public function all(): array;
    public function find(int $id): ?Review;
    public function findByProductId(int $productId): array;
    public function create(Review $review): void;
    public function update(Review $review): void;
    public function delete(int $id): void;
}
