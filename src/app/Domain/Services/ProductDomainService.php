<?php

namespace App\Domain\Services;

use App\Domain\Entities\Product;
use App\Domain\Entities\Review;

class ProductDomainService
{
    public function validateDiscount(Product $product): void
    {
        if ($product->getDiscount()->value() > $product->getPrice()->value()) {
            throw new \InvalidArgumentException('Discount cannot exceed price.');
        }
    }

    public function validateReview(Review $review, int $productId): void
    {
        if ($review->getProductId() !== $productId) {
            throw new \InvalidArgumentException('Review does not belong to this product.');
        }
        if (empty($review->getUserName())) {
            throw new \InvalidArgumentException('User name cannot be empty.');
        }
    }
}
