<?php

namespace App\Application\UseCases\Category;

use App\Application\DTO\Input\CreateCategoryInputDTO;
use App\Application\DTO\Output\CategoryOutputDTO;
use App\Domain\Entities\Category;
use App\Domain\Repositories\CategoryRepositoryInterface;
use App\Domain\ValueObjects\CategoryName;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class CreateCategoryUseCase
{
    public function __construct(
        private CategoryRepositoryInterface $categoryRepository
    ) {}

    public function execute(CreateCategoryInputDTO $inputDTO): CategoryOutputDTO
    {
        try {
            $category = new Category(new CategoryName($inputDTO->name));
            $this->categoryRepository->save($category);

            return CategoryOutputDTO::fromEntity($category);
        } catch (InvalidArgumentException $e) {
            throw $e;
        } catch (\Exception $e) {
            throw new \Exception('Failed to create category');
        }
    }
}
