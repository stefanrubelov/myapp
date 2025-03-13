<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domains\Expenses\Payment\Helpers\PaymentNumberGenerator;
use App\Domains\Expenses\Payment\Model\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect(range(1, 1000))->each(function () {
            Payment::factory()->create([
                'payment_number' => PaymentNumberGenerator::generate(),
            ]);
        });
    }
}
