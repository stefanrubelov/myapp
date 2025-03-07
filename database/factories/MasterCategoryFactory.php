<?php

namespace Database\Factories;

use App\Enums\MasterCategoryEnum;
use App\Models\MasterCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MasterCategory>
 */
class MasterCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(MasterCategoryEnum::values()),
        ];
    }
}
