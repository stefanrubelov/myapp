<?php

declare(strict_types=1);

namespace App\Domains\Expenses\Product\Factories;

use App\Domains\Expenses\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    public function modelName(): string
    {
        return Product::class;
    }
}
