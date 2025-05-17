<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repositories\CategoryRepositoryInterface;
use App\Models\Categories;
use App\Models\User;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function all()
    {
        return Categories::all();
    }

    public function findById()
    {

    }

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}
