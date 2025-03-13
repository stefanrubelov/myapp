<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domains\Expenses\PaymentMethod\Enums\PaymentMethodEnum;
use App\Domains\Expenses\PaymentMethod\Models\PaymentMethod;
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
