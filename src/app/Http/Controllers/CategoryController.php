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
            return response()->json(['error' => 'Server error'], 500);
        }
    }

    public function store(StoreCategoryRequest $request): JsonResponse
    {
        try {
            $inputDTO = CreateCategoryInputDTO::fromRequest($request);
            $outputDTO = $this->createCategoryUseCase->execute($inputDTO);
            return response()->json((array) $outputDTO, 201);
        } catch (InvalidArgumentException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error'], 500);
        }
    }
}
