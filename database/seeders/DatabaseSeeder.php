<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            TransactionTypeSeeder::class,
            PaymentMethodSeeder::class,
            MasterCategorySeeder::class,
            CategoryTypeSeeder::class,
            UserSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            MerchantSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
