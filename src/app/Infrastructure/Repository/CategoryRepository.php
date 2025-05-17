<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entities\Category;
use App\Domain\Repositories\CategoryRepositoryInterface;
use App\Domain\ValueObjects\CategoryName;
use App\Infrastructure\Models\EloquentCategory;
use App\Infrastructure\Models\EloquentProduct;
use App\Models\Categories;


class CategoryRepository implements CategoryRepositoryInterface
{
    public function save(Category $category): void
    {
        if ($category->getId()) {
            $this->update($category);
        } else {
            $this->create($category);
        }
    }

    public function findById(int $id): ?Category
    {
        $eloquentCategory = EloquentCategory::find($id);

        if (!$eloquentCategory) {
            return null;
        }

        $category = new Category(new CategoryName($eloquentCategory->name));
        $category->setId($eloquentCategory->id);
        return $category;
    }

    public function all(): array
    {
        $eloquentCategories = EloquentCategory::all();
        $categories = [];

        foreach ($eloquentCategories as $eloquentCategory) {
            $category = new Category(new CategoryName($eloquentCategory->name));
            $category->setId($eloquentCategory->id);
            $categories[] = $category;
        }

        return $categories;
    }

    public function update(): void
    {
        // TODO
    }

    public function delete(int $id): void
    {
        $eloquentCategory = EloquentCategory::find($id);

        if (!$eloquentCategory) {
            throw new \Exception('Category not found');
        }

        $eloquentCategory->delete();
    }

    private function create(Category $category): void
    {
        $eloquentCategory = new EloquentCategory();
        $eloquentCategory->name = $category->getName()->value();
        $eloquentCategory->save();

        $category->setId($eloquentCategory->id);
    }
}
