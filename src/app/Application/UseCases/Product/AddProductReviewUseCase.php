<?php

namespace App\Application\UseCases\Product;

use App\Application\DTO\Input\CreateProductReviewInputDTO;
use App\Application\DTO\Output\ReviewOutputDTO;
use App\Domain\Entities\Review;
use App\Domain\Repositories\ProductRepositoryInterface;
use App\Domain\Repositories\ReviewRepositoryInterface;
use App\Domain\ValueObjects\ProductCode;
use App\Domain\ValueObjects\Rating;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class AddProductReviewUseCase
{
    public function __construct(
        private ProductRepositoryInterface $productRepository,
        private ReviewRepositoryInterface $reviewRepository
    ) {}

    public function execute(CreateProductReviewInputDTO $inputDTO): ReviewOutputDTO
    {
        try {
            Log::info('Creating review for product', ['code' => $inputDTO->code, 'user_name' => $inputDTO->userName]);

            $product = $this->productRepository->findByCode(new ProductCode($inputDTO->code));
            if (!$product) {
                throw new InvalidArgumentException('Product not found');
            }

            $review = new Review(
                new Rating($inputDTO->rating),
                $inputDTO->text,
                $inputDTO->userName,
                $product->getId()
            );

            $this->reviewRepository->create($review);

            Log::info('Review created successfully', ['product_id' => $product->getId(), 'user_name' => $inputDTO->userName]);

            return ReviewOutputDTO::fromEntity($review);
        } catch (InvalidArgumentException $e) {
            Log::warning('Invalid review input', ['error' => $e->getMessage()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Failed to create review', ['error' => $e->getMessage()]);
            throw new \Exception('Failed to create review');
        }
    }
}
