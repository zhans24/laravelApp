<?php

namespace App\Application\DTO\Input;

use Illuminate\Http\Request;
use InvalidArgumentException;

class CreateProductReviewInputDTO
{
    public function __construct(
        public readonly string $code,
        public readonly string $userName,
        public readonly string $text,
        public readonly int $rating
    ) {}

    public static function fromRequest(Request $request, string $code): self
    {
        $userName = $request->input('user_name');
        $text = $request->input('text');
        $rating = (int) $request->input('rating');

        if (empty($userName) || strlen($userName) > 100) {
            throw new InvalidArgumentException('User name must be non-empty and less than 100 characters.');
        }

        if (empty($text)) {
            throw new InvalidArgumentException('Review text must be non-empty.');
        }

        if ($rating < 1 || $rating > 5) {
            throw new InvalidArgumentException('Rating must be between 1 and 5.');
        }

        return new self($code, $userName, $text, $rating);
    }
}
