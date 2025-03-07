<?php

namespace Database\Factories;

use App\Enums\CategoryTypeEnum;
use App\Models\CategoryType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<CategoryType>
 */
class CategoryTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(CategoryTypeEnum::values()),
        ];
    }
}
