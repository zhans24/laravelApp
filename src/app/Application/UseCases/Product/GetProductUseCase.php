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
        Log::info('Executing GetProductUseCase', ['code' => $code->value()]);
        try {
            $product = $this->productRepository->findByCode($code);
            if (!$product) {
                Log::warning('Product not found', ['code' => $code->value()]);
                throw new InvalidArgumentException('Product with code ' . $code->value() . ' not found');
            }

            Log::debug('Product found', ['product_id' => $product->getId(), 'code' => $code->value()]);

            $reviews = $this->reviewRepository->findByProductId($product->getId());
            Log::debug('Reviews fetched', ['product_id' => $product->getId(), 'review_count' => count($reviews)]);

            return ProductWithReviewsOutputDTO::fromEntity($product, $reviews);
        } catch (InvalidArgumentException $e) {
            Log::warning('Invalid product code', ['code' => $code->value(), 'error' => $e->getMessage()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Failed to fetch product', ['code' => $code->value(), 'error' => $e->getMessage()]);
            throw new \Exception('Failed to fetch product: ' . $e->getMessage());
        }
    }
}
