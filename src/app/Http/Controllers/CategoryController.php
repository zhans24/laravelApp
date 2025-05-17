<?php

namespace App\Http\Controllers;

use App\Application\UseCases\Category\GetAllCategoriesUseCase;
use App\Application\DTO\Output\CategoryOutputDTO;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    private GetAllCategoriesUseCase $getAllCategoriesUseCase;

    public function __construct(GetAllCategoriesUseCase $getAllCategoriesUseCase)
    {
        $this->getAllCategoriesUseCase = $getAllCategoriesUseCase;
    }

    public function index(): JsonResponse
    {
        $categories = $this->getAllCategoriesUseCase->execute();
        return response()->json(array_map(fn(CategoryOutputDTO $dto) => (array) $dto, $categories));
    }
}
