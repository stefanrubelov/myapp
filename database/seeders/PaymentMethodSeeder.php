<?php

namespace Database\Seeders;

use App\Enums\PaymentMethodEnum;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (PaymentMethodEnum::values() as $paymentMethod) {
            PaymentMethod::create([
                'name' => $paymentMethod,
                'is_enabled' => true]);
        }
    }
}
