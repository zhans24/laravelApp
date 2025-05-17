<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Category;

interface CategoryRepositoryInterface
{
    public function all();
    public function findById(int $id);
    public function save(Category $category);
    public function update();
    public function delete(int $id);
}
