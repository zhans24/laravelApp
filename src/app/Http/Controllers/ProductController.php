<?php

namespace App\Http\Controllers;

use App\Application\DTO\Input\CreateProductInputDTO;
use App\Application\DTO\Input\CreateProductReviewInputDTO;
use App\Application\UseCases\Product\AddProductReviewUseCase;
use App\Application\UseCases\Product\CreateProductUseCase;
use App\Application\UseCases\Product\GetAllProductsUseCase;
use App\Application\UseCases\Product\GetProductUseCase;
use App\Domain\ValueObjects\ProductCode;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\StoreProductReviewRequest;
use Illuminate\Http\JsonResponse;
use InvalidArgumentException;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    private GetProductUseCase $getProductUseCase;
    private AddProductReviewUseCase $addProductReviewUseCase;
    private CreateProductUseCase $createProductUseCase;
    private GetAllProductsUseCase $getAllProductsUseCase;

    public function __construct(
        GetProductUseCase $getProductUseCase,
        AddProductReviewUseCase $addProductReviewUseCase,
        CreateProductUseCase $createProductUseCase,
        GetAllProductsUseCase $getAllProductsUseCase
    ) {
        $this->getProductUseCase = $getProductUseCase;
        $this->addProductReviewUseCase = $addProductReviewUseCase;
        $this->createProductUseCase = $createProductUseCase;
        $this->getAllProductsUseCase = $getAllProductsUseCase;
    }

    public function index(): JsonResponse
    {
        try {
            $products = $this->getAllProductsUseCase->execute();
            return response()->json(array_map(fn($dto) => $dto->toArray(), $products));
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function showWithReviews(string $code): JsonResponse
    {
        try {
            $dto = $this->getProductUseCase->execute(new ProductCode($code));
            return response()->json($dto->toArray());
        } catch (InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function storeReview(string $code, StoreProductReviewRequest $request): JsonResponse
    {
        try {
            $inputDTO = CreateProductReviewInputDTO::fromRequest($request, $code);
            $outputDTO = $this->addProductReviewUseCase->execute($inputDTO);
            return response()->json($outputDTO->toArray(), 201);
        } catch (InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        try {
            $inputDTO = CreateProductInputDTO::fromRequest($request);
            $outputDTO = $this->createProductUseCase->execute($inputDTO);
            return response()->json($outputDTO->toArray(), 201);
        } catch (InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }
}
