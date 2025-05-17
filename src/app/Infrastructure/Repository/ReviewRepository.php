<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repositories\ReviewRepositoryInterface;
use App\Domain\Entities\Review;
use App\Domain\ValueObjects\Rating;
use App\Infrastructure\Models\EloquentReview;

class ReviewRepository implements ReviewRepositoryInterface
{
    public function all(): array
    {
        $eloquentReviews = EloquentReview::all();
        $reviews = [];

        foreach ($eloquentReviews as $eloquentReview) {
            $reviews[] = $this->toEntity($eloquentReview);
        }

        return $reviews;
    }

    public function find(int $id): ?Review
    {
        $eloquentReview = EloquentReview::find($id);

        if (!$eloquentReview) {
            return null;
        }

        return $this->toEntity($eloquentReview);
    }

    public function findByProductId(int $productId): array
    {
        $eloquentReviews = EloquentReview::where('product_id', $productId)->get();
        $reviews = [];

        foreach ($eloquentReviews as $eloquentReview) {
            $reviews[] = $this->toEntity($eloquentReview);
        }

        return $reviews;
    }

    public function create(Review $review): void
    {
        $eloquentReview = new EloquentReview();
        $this->fillEloquentModel($eloquentReview, $review);
        $eloquentReview->save();

        $review->setId($eloquentReview->id);
    }

    public function update(Review $review): void
    {
        $eloquentReview = EloquentReview::find($review->getId());

        if (!$eloquentReview) {
            throw new \Exception('Review not found');
        }

        $this->fillEloquentModel($eloquentReview, $review);
        $eloquentReview->save();
    }

    public function delete(int $id): void
    {
        $eloquentReview = EloquentReview::find($id);

        if (!$eloquentReview) {
            throw new \Exception('Review not found');
        }

        $eloquentReview->delete();
    }

    private function toEntity(EloquentReview $eloquentReview): Review
    {
        $review = new Review(
            new Rating($eloquentReview->rating),
            $eloquentReview->text,
            $eloquentReview->user_name,
            $eloquentReview->product_id
        );
        $review->setId($eloquentReview->id);
        return $review;
    }

    private function fillEloquentModel(EloquentReview $eloquentReview, Review $review): void
    {
        $eloquentReview->product_id = $review->getProductId();
        $eloquentReview->user_name = $review->getUserName();
        $eloquentReview->text = $review->getText();
        $eloquentReview->rating = $review->getRating()->value();
    }
}
