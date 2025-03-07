<?php

namespace Database\Seeders;

use App\Models\TransactionType;
use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionType::create(['name' => 'outgoing', 'is_enabled' => true]);
        TransactionType::create(['name' => 'incoming', 'is_enabled' => true]);
    }
}
