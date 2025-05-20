<?php

namespace App\Application\UseCases\Product;

use App\Application\DTO\Output\ProductWithReviewsOutputDTO;
use App\Domain\Repositories\ProductRepositoryInterface;
use App\Domain\Repositories\ReviewRepositoryInterface;
use App\Domain\ValueObjects\ProductCode;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class GetProductUseCase
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private ReviewRepositoryInterface $reviewRepository
    ) {}

    public function execute(ProductCode $code): ProductWithReviewsOutputDTO
    {
        try {
            $product = $this->productRepository->findByCode($code);
            if (!$product) {
                throw new InvalidArgumentException('Product with code ' . $code->value() . ' not found');
            }


            $reviews = $this->reviewRepository->findByProductId($product->getId());

            return ProductWithReviewsOutputDTO::fromEntity($product, $reviews);
        } catch (InvalidArgumentException $e) {
            Log::warning('Invalid product code', ['code' => $code->value(), 'error' => $e->getMessage()]);
            throw $e;
        }
    }
}
