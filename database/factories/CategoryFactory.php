<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\CategoryType;
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
     *
     * @param $parentId
     * @return Factory
     */
    public function withParent($parentId): Factory
    {
        return $this->state([
            'parent_id' => $parentId,
        ]);
    }
}
