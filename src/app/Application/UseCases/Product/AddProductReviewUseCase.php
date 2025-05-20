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


            return ReviewOutputDTO::fromEntity($review);
        } catch (InvalidArgumentException $e) {
            throw $e;
        }
    }
}
