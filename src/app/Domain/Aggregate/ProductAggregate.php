<?php

namespace App\Domain\Aggregate;


use App\Domain\Entities\Product;
use App\Domain\Entities\Review;
use App\Domain\Services\ProductDomainService;

class ProductAggregate
{
    private Product $product;
    private ProductDomainService $domainService;

    public function __construct(Product $product, ProductDomainService $domainService)
    {
        $this->product = $product;
        $this->domainService = $domainService;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function addReview(Review $review): void
    {
        $this->domainService->validateReview($review, $this->product);
        $this->product->addReview($review);
    }
}
