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
            Log::info('Fetching all products');
            $products = $this->getAllProductsUseCase->execute();
            return response()->json(array_map(fn($dto) => $dto->toArray(), $products));
        } catch (\Exception $e) {
            Log::error('Failed to fetch products', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function showWithReviews(string $code): JsonResponse
    {
        Log::debug('Received show product with reviews request', ['code' => $code]);
        try {
            Log::info('Fetching product with reviews', ['code' => $code]);
            $dto = $this->getProductUseCase->execute(new ProductCode($code));
            Log::info('Product fetched successfully', ['code' => $code, 'product_id' => $dto->id]);
            return response()->json($dto->toArray());
        } catch (InvalidArgumentException $e) {
            Log::warning('Product not found', ['code' => $code, 'error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 404);
        } catch (\Exception $e) {
            Log::error('Failed to fetch product', ['code' => $code, 'error' => $e->getMessage()]);
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function storeReview(string $code, StoreProductReviewRequest $request): JsonResponse
    {
        Log::debug('Received review request', ['code' => $code, 'input' => $request->all()]);
        try {
            Log::info('Processing store review request', ['code' => $code, 'input' => $request->all()]);
            $inputDTO = CreateProductReviewInputDTO::fromRequest($request, $code);
            $outputDTO = $this->addProductReviewUseCase->execute($inputDTO);
            Log::info('Review stored successfully', ['id' => $outputDTO->id, 'product_code' => $code, 'created_at' => $outputDTO->createdAt]);
            return response()->json($outputDTO->toArray(), 201);
        } catch (InvalidArgumentException $e) {
            Log::warning('Invalid review input', ['code' => $code, 'error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            Log::error('Failed to store review', ['code' => $code, 'error' => $e->getMessage()]);
            return response()->json(['error' => 'Failed to store review: ' . $e->getMessage()], 500);
        }
    }

    public function store(StoreProductRequest $request): JsonResponse
    {
        try {
            Log::info('Processing store product request', ['input' => $request->all()]);
            $inputDTO = CreateProductInputDTO::fromRequest($request);
            $outputDTO = $this->createProductUseCase->execute($inputDTO);
            Log::info('Product stored successfully', ['id' => $outputDTO->id, 'code' => $outputDTO->code]);
            return response()->json($outputDTO->toArray(), 201);
        } catch (InvalidArgumentException $e) {
            Log::warning('Invalid product input', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            Log::error('Failed to store product', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Server error'], 500);
        }
    }
}
