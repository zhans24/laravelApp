<?php

namespace App\Application\UseCases\Product;

use App\Application\DTO\Output\ProductOutputDTO;
use App\Domain\Repositories\ProductRepositoryInterface;

class GetAllProductsUseCase
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function execute(): array
    {
        $products = $this->productRepository->all();
        return array_map(fn($product) => ProductOutputDTO::fromEntity($product), $products);
    }
}
