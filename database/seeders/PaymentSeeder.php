<?php

namespace Database\Seeders;

use App\Helpers\PaymentNumberGenerator;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        collect(range(1, 100))->each(function () {
            Payment::factory()->create([
                'payment_number' => PaymentNumberGenerator::generate()
            ]);
        });
    }
}
