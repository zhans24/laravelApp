<?php

namespace Database\Factories;

use App\Infrastructure\Models\EloquentProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class EloquentProductFactory extends Factory
{
    protected $model = EloquentProduct::class;

    public function definition()
    {
        return [
            'code' => strtoupper('PRD' . $this->faker->unique()->regexify('[A-Z0-9]{10}')),
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'discount' => $this->faker->randomFloat(2, 0, 100),
            'photo' => null,
            'category_id' => 1,
        ];
    }
}
