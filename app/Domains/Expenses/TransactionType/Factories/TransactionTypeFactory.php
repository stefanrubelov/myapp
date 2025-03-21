<?php

declare(strict_types=1);

namespace App\Domains\Expenses\TransactionType\Factories;

use App\Domains\Expenses\TransactionType\Enums\TransactionTypeEnum;
use App\Domains\Expenses\TransactionType\Models\TransactionType;
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

    public function modelName(): string
    {
        return TransactionType::class;
    }
}
