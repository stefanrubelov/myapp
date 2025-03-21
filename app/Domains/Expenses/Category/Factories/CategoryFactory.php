<?php

declare(strict_types=1);

namespace App\Domains\Expenses\Category\Factories;

use App\Domains\Expenses\Category\Models\Category;
use App\Domains\Expenses\CategoryType\Models\CategoryType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoryType = CategoryType::inRandomOrder()->first();

        return [
            'name' => $this->faker->word,
            'parent_id' => null,
            'category_type_id' => $categoryType->id,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the category is a subcategory.
     */
    public function withParent($parentId): Factory
    {
        return $this->state([
            'parent_id' => $parentId,
        ]);
    }

    public function modelName(): string
    {
        return Category::class;
    }
}
