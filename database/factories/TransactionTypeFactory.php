<?php

namespace Database\Factories;

use App\Enums\TransactionTypeEnum;
use App\Models\TransactionType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<TransactionType>
 */
class TransactionTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(TransactionTypeEnum::values()),
            'is_enabled' => $this->faker->boolean(),
        ];
    }
}
