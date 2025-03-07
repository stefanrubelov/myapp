<?php

namespace Database\Factories;

use App\Helpers\PaymentNumberGenerator;
use App\Models\Merchant;
use App\Models\Payment;
use App\Models\PaymentMethod;
use App\Models\Product;
use App\Models\TransactionType;
use App\Models\User;
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
            'discounted'=> $this->faker->boolean(),
            'payment_date' => $this->faker->date(),
            'payment_number' => PaymentNumberGenerator::generate(),
        ];
    }
}
