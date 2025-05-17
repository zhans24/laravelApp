<?php

namespace App\Http\Controllers;

use App\Dto\Input\CreateProductInputDto;
use App\Dto\Input\AddReviewInputDto;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\StoreReviewRequest;
use App\UseCases\GetAllProductsUseCase;
use App\UseCases\CreateProductUseCase;
use App\UseCases\AddReviewUseCase;
use App\Interfaces\ProductServiceInterface;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(GetAllProductsUseCase $useCase): JsonResponse
    {
        $products = $useCase->execute();
        return response()->json(['data' => array_map(fn($dto) => $dto->toArray(), $products)]);
    }

    public function show(int $id, ProductServiceInterface $productService): JsonResponse
    {
        $product = $productService->getProductById($id);
        return response()->json(['data' => $product->toArray()]);
    }

    public function store(StoreProductRequest $request, CreateProductUseCase $useCase): JsonResponse
    {
        $inputDto = CreateProductInputDto::fromArray($request->validated());
        $product = $useCase->execute($inputDto);
        return response()->json($product->toArray(), 201);
    }

    public function addReview(int $productId, StoreReviewRequest $request, AddReviewUseCase $useCase): JsonResponse
    {
        $inputDto = AddReviewInputDto::fromArray($request->validated());
        $review = $useCase->execute($productId, $inputDto);
        return response()->json($review->toArray(), 201);
    }
}
