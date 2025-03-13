<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\Expenses\PaymentMethod\Enums\PaymentMethodEnum;
use App\Domains\Expenses\PaymentMethod\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<PaymentMethod>
 */
class PaymentMethodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(PaymentMethodEnum::values()),
            'is_enabled' => $this->faker->boolean(),
        ];
    }
}
