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

        return new self($code, $userName, $text, $rating);
    }
}
