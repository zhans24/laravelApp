<?php

namespace App\Http\Controllers;

use App\Application\DTO\Input\CreateCategoryInputDTO;
use App\Application\DTO\Output\CategoryOutputDTO;
use App\Application\UseCases\Category\CreateCategoryUseCase;
use App\Application\UseCases\Category\GetAllCategoriesUseCase;
use App\Http\Requests\StoreCategoryRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class CategoryController extends Controller
{
    private GetAllCategoriesUseCase $getAllCategoriesUseCase;
    private CreateCategoryUseCase $createCategoryUseCase;

    public function __construct(
        GetAllCategoriesUseCase $getAllCategoriesUseCase,
        CreateCategoryUseCase $createCategoryUseCase
    ) {
        $this->getAllCategoriesUseCase = $getAllCategoriesUseCase;
        $this->createCategoryUseCase = $createCategoryUseCase;
    }

    public function index(): JsonResponse
    {
        try {
            $categories = $this->getAllCategoriesUseCase->execute();
            return response()->json(array_map(fn(CategoryOutputDTO $dto) => (array) $dto, $categories));
        } catch (\Exception $e) {
            Log::error('Failed to fetch categories', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        try {
            Log::info('Processing store category request', ['input' => $request->all()]);
            $inputDTO = CreateCategoryInputDTO::fromRequest($request);
            $outputDTO = $this->createCategoryUseCase->execute($inputDTO);
            Log::info('Category stored successfully', ['id' => $outputDTO->id, 'name' => $outputDTO->name]);
            return response()->json((array) $outputDTO, 201);
        } catch (InvalidArgumentException $e) {
            Log::warning('Invalid category input', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            Log::error('Failed to store category', ['error' => $e->getMessage()]);
            return response()->json(['error' => 'Server error'], 500);
        }
    }
}
