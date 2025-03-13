<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\Expenses\CategoryType\Enums\CategoryTypeEnum;
use App\Domains\Expenses\CategoryType\Models\CategoryType;
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
