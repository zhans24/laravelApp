<?php

namespace App\Application\UseCases\Product;

use App\Application\DTO\Input\CreateProductInputDTO;
use App\Application\DTO\Output\ProductOutputDTO;
use App\Domain\Entities\Product;
use App\Domain\Services\ProductDomainService;
use App\Domain\ValueObjects\Price;
use App\Domain\ValueObjects\ProductCode;
use App\Infrastructure\Repository\CategoryRepository;
use App\Infrastructure\Repository\ProductRepository;
use http\Exception\InvalidArgumentException;

class CreateProductUseCase
{
    public function __construct(
        private ProductRepository $productRepository,
        private ProductDomainService $productDomainService,
        private CategoryRepository $categoryRepository,
    ){}

    public function execute(CreateProductInputDTO $productInputDTO):ProductOutputDTO
    {
        if (!$this->categoryRepository->findById($productInputDTO->categoryId)){
            throw new InvalidArgumentException("Category doesn't exist");
        };

        $product = new Product(
            new ProductCode($productInputDTO->code),
            $productInputDTO->name,
            $productInputDTO->description,
            new Price($productInputDTO->price),
            new Price($productInputDTO->discount),
            $productInputDTO->photo,
            $productInputDTO->categoryId
        );

        $this->productDomainService->validateDiscount($product);
        $this->productRepository->save($product);
        return ProductOutputDTO::fromEntity($product);
    }
}
