<?php

namespace App\Application\DTO\Input;

use Illuminate\Http\Request;

class CreateReviewInputDTO
{
    public int $rating;
    public string $text;
    public string $userName;
    public int $productId;

    public function __construct(int $rating, string $text, string $userName, int $productId)
    {
        $this->rating = $rating;
        $this->text = $text;
        $this->userName = $userName;
        $this->productId = $productId;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            (int) $request->input('rating'),
            $request->input('text'),
            $request->input('user_name'),
            (int) $request->input('product_id')
        );
    }
}
