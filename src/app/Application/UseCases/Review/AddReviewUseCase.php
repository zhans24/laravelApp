<?php

namespace App\Application\UseCases;

use App\Application\DTO\Input\CreateReviewInputDTO;
use App\Application\DTO\Output\ReviewOutputDTO;
use App\Domain\Repositories\ProductRepositoryInterface;
use App\Domain\Repositories\ReviewRepositoryInterface;
use App\Domain\Services\ProductDomainService;
use App\Domain\Entities\Review;
use App\Domain\ValueObjects\Rating;

class AddReviewUseCase
{
    private ReviewRepositoryInterface $reviewRepository;
    private ProductRepositoryInterface $productRepository;
    private ProductDomainService $domainService;

    public function __construct(
        ReviewRepositoryInterface $reviewRepository,
        ProductRepositoryInterface $productRepository,
        ProductDomainService $domainService
    ) {
        $this->reviewRepository = $reviewRepository;
        $this->productRepository = $productRepository;
        $this->domainService = $domainService;
    }

    public function execute(CreateReviewInputDTO $inputDTO): ReviewOutputDTO
    {
        if (!$this->productRepository->findById($inputDTO->productId)) {
            throw new \InvalidArgumentException('Product does not exist.');
        }

        $review = new Review(
            new Rating($inputDTO->rating),
            $inputDTO->text,
            $inputDTO->userName,
            $inputDTO->productId
        );

        $this->domainService->validateReview($review, $inputDTO->productId);
        $this->reviewRepository->save($review);

        return ReviewOutputDTO::fromEntity($review);
    }
}
