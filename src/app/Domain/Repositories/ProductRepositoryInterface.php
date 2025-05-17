<?php

namespace App\Domain\Repositories;

interface ProductRepositoryInterface
{
    public function all();
    public function findById();
    public function save();
    public function update();
    public function delete();
}
