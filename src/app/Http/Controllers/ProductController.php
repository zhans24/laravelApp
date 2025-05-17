<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Product\GetProductUseCase;
use App\Application\DTO\Output\ProductWithReviewsOutputDTO;
use App\Domain\ValueObjects\ProductCode;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    private GetProductUseCase $getProductUseCase;

    public function __construct(GetProductUseCase $getProductUseCase)
    {
        $this->getProductUseCase = $getProductUseCase;
    }

    public function showWithReviews(int $category, string $product_code): JsonResponse
    {
        $dto = $this->getProductUseCase->execute($category, new ProductCode($product_code));
        return response()->json((array) $dto);
    }
}
