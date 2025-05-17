<?php

namespace App\Application\UseCases\Category;

use App\Application\DTO\Output\CategoryOutputDTO;
use App\Domain\Repositories\CategoryRepositoryInterface;

class GetAllCategoriesUseCase
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function execute(): array
    {
        $categories = $this->categoryRepository->all();
        return array_map(fn($category) => CategoryOutputDTO::fromEntity($category), $categories);
    }
}
