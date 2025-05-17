<?php

namespace App\Domain\Services;

use App\Domain\Entities\Product;
use App\Domain\Entities\Review;
use InvalidArgumentException;

class ProductDomainService
{
    public function validateReview(Review $review,Product $product): void
    {
        if ($review->getProductId() !== $product->getId()){
            throw new InvalidArgumentException("Review does not belong to this product");
        }
    }

    public function validateDiscount(Product $product, float $discount): void
    {
        if ($discount > $product->getPrice()->value()) {
            throw new InvalidArgumentException('Discount cannot exceed price');
        }
    }
}
