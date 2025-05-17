<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Product;
use App\Domain\ValueObjects\ProductCode;

interface ProductRepositoryInterface
{
    public function all():array;
    public function findByCode(ProductCode $code);
    public function findById(int $id);

    public function save(Product $product): void;
    public function update(Product $product): void;
    public function delete(int $id): void;
}
