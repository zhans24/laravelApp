<?php

namespace App\Application\UseCases\Category;

use App\Application\DTO\Output\CategoryOutputDTO;
use App\Domain\Repositories\CategoryRepositoryInterface;

class GetCategoryUseCase
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function execute(int $id): ?CategoryOutputDTO
    {
        $category = $this->categoryRepository->findById($id);
        return $category ? CategoryOutputDTO::fromEntity($category) : null;
    }
}
