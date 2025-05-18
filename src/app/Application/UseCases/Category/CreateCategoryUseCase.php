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
            Log::info('Creating category', ['name' => $inputDTO->name]);

            $category = new Category(new CategoryName($inputDTO->name));
            $this->categoryRepository->save($category);

            Log::info('Category created successfully', ['id' => $category->getId(), 'name' => $inputDTO->name]);

            return CategoryOutputDTO::fromEntity($category);
        } catch (InvalidArgumentException $e) {
            Log::error('Failed to create category: Invalid argument', ['error' => $e->getMessage()]);
            throw $e;
        } catch (\Exception $e) {
            Log::error('Failed to create category: Server error', ['error' => $e->getMessage()]);
            throw new \Exception('Failed to create category');
        }
    }
}
