<?php

namespace App\Domain\Repositories;

interface CategoryRepositoryInterface
{
    public function all();
    public function findById();
    public function save();
    public function update();
    public function delete();
}
