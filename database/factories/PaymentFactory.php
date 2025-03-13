<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domains\Expenses\Merchant\Models\Merchant;
use App\Domains\Expenses\Payment\Helpers\PaymentNumberGenerator;
use App\Domains\Expenses\Payment\Model\Payment;
use App\Domains\Expenses\PaymentMethod\Models\PaymentMethod;
use App\Domains\Expenses\Product\Models\Product;
use App\Domains\Expenses\TransactionType\Models\TransactionType;
use App\Domains\User\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();
        $merchant = Merchant::inRandomOrder()->first();
        $user = User::first();
        $transactionType = TransactionType::inRandomOrder()->first();
        $paymentMethod = PaymentMethod::inRandomOrder()->first();

        return [
            'price' => $this->faker->randomFloat(2, 1, 50),
            'merchant_id' => $merchant->id,
            'product_id' => $product->id,
            'transaction_type_id' => $transactionType->id,
            'payment_method_id' => $paymentMethod->id,
            'note' => $this->faker->realText(),
            'user_id' => $user->id,
            'discounted' => $this->faker->boolean(),
            'payment_date' => $this->faker->date(),
            'payment_number' => PaymentNumberGenerator::generate(),
        ];
    }
}
