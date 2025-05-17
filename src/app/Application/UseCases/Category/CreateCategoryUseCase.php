<?php

namespace App\Application\UseCases\Category;

use App\Application\DTO\Input\CreateCategoryInputDTO;
use App\Application\DTO\Output\CategoryOutputDTO;
use App\Domain\Repositories\CategoryRepositoryInterface;
use App\Domain\Entities\Category;
use App\Domain\ValueObjects\CategoryName;

class CreateCategoryUseCase
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function execute(CreateCategoryInputDTO $inputDTO): CategoryOutputDTO
    {
        $category = new Category(new CategoryName($inputDTO->name));
        $this->categoryRepository->save($category);
        return CategoryOutputDTO::fromEntity($category);
    }
}
