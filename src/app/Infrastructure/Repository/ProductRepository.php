<?php

namespace App\Infrastructure\Repository;

use App\Domain\Repositories\ProductRepositoryInterface;
use App\Domain\Entities\Product;
use App\Domain\ValueObjects\ProductCode;
use App\Domain\ValueObjects\Price;
use App\Infrastructure\Models\EloquentProduct;

class ProductRepository implements ProductRepositoryInterface
{
    public function save(Product $product): void
    {
        if ($product->getId()) {
            $this->update($product);
        } else {
            $this->create($product);
        }
    }

    public function findByCode(ProductCode $code): ?Product
    {
        $eloquentProduct = EloquentProduct::where('code', $code->value())->first();

        if (!$eloquentProduct) {
            return null;
        }

        $product = new Product(
            new ProductCode($eloquentProduct->code),
            $eloquentProduct->name,
            $eloquentProduct->description,
            new Price($eloquentProduct->price),
            new Price($eloquentProduct->discount),
            $eloquentProduct->photo,
            $eloquentProduct->category_id
        );
        $product->setId($eloquentProduct->id);
        return $product;
    }

    public function all(): array
    {
        $eloquentProducts = EloquentProduct::all();
        $products = [];

        foreach ($eloquentProducts as $eloquentProduct) {
            $product = new Product(
                new ProductCode($eloquentProduct->code),
                $eloquentProduct->name,
                $eloquentProduct->description,
                new Price($eloquentProduct->price),
                new Price($eloquentProduct->discount),
                $eloquentProduct->photo,
                $eloquentProduct->category_id
            );
            $product->setId($eloquentProduct->id);
            $products[] = $product;
        }

        return $products;
    }

    public function update(Product $product): void
    {
        $eloquentProduct = EloquentProduct::find($product->getId());

        if (!$eloquentProduct) {
            throw new \Exception('Product not found');
        }

        $this->toEntity($product, $eloquentProduct);
    }

    public function delete(int $id): void
    {
        $eloquentProduct = EloquentProduct::find($id);

        if (!$eloquentProduct) {
            throw new \Exception('Product not found');
        }

        $eloquentProduct->delete();
    }

    private function create(Product $product): void
    {
        $eloquentProduct = new EloquentProduct();
        $this->toEntity($product, $eloquentProduct);

        $product->setId($eloquentProduct->id);
    }

    /**
     * @param Product $product
     * @param $eloquentProduct
     * @return void
     */
    private function toEntity(Product $product, $eloquentProduct): void
    {
        $eloquentProduct->code = $product->getCode()->value();
        $eloquentProduct->name = $product->getName();
        $eloquentProduct->description = $product->getDescription();
        $eloquentProduct->price = $product->getPrice()->value();
        $eloquentProduct->discount = $product->getDiscount()->value();
        $eloquentProduct->photo = $product->getPhoto();
        $eloquentProduct->category_id = $product->getCategoryId();
        $eloquentProduct->save();
    }

    public function findById(int $id) : ?Product
    {
        $eloquentProduct = EloquentProduct::find($id);

        if (!$eloquentProduct) {
            return null;
        }

        $product = new Product(
            new ProductCode($eloquentProduct->code),
            $eloquentProduct->name,
            $eloquentProduct->description,
            new Price($eloquentProduct->price),
            new Price($eloquentProduct->discount),
            $eloquentProduct->photo,
            $eloquentProduct->category_id
        );
        $product->setId($eloquentProduct->id);
        return $product;
    }
}
