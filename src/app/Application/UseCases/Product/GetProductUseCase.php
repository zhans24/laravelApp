<?php

namespace App\Application\UseCases\Product;

use App\Application\DTO\Output\ProductWithReviewsOutputDTO;
use App\Domain\Repositories\ProductRepositoryInterface;
use App\Domain\Repositories\ReviewRepositoryInterface;
use App\Domain\ValueObjects\ProductCode;
use InvalidArgumentException;

class GetProductUseCase
{
    private ProductRepositoryInterface $productRepository;
    private ReviewRepositoryInterface $reviewRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        ReviewRepositoryInterface $reviewRepository
    ) {
        $this->productRepository = $productRepository;
        $this->reviewRepository = $reviewRepository;
    }

    public function execute(int $categoryId, ProductCode $code): ProductWithReviewsOutputDTO
    {
        $product = $this->productRepository->findByCode($code);
        if (!$product || $product->getCategoryId() !== $categoryId) {
            throw new InvalidArgumentException('Product not found or does not belong to category');
        }

        $reviews = $this->reviewRepository->findByProductId($product->getId());

        return ProductWithReviewsOutputDTO::fromEntity($product, $reviews);
    }
}
