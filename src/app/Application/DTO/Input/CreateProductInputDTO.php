<?php

namespace App\Application\DTO\Input;

use Illuminate\Http\Request;

class CreateProductInputDTO
{
    public string $code;
    public string $name;
    public ?string $description;
    public float $price;
    public float $discount;
    public ?string $photo;
    public int $categoryId;

    public function __construct(
        string $code,
        string $name,
        ?string $description,
        float $price,
        float $discount,
        ?string $photo,
        int $categoryId
    ) {
        $this->code = $code;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->discount = $discount;
        $this->photo = $photo;
        $this->categoryId = $categoryId;
    }

    public static function fromRequest(Request $request): self
    {
        return new self(
            $request->input('code'),
            $request->input('name'),
            $request->input('description'),
            (float) $request->input('price'),
            (float) $request->input('discount', 0),
            $request->input('photo'),
            (int) $request->input('category_id')
        );
    }
}
