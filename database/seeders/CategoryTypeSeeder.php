<?php

namespace Database\Seeders;

use App\Models\CategoryType;
use Illuminate\Database\Seeder;

class CategoryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryType::factory()->create([
            'name' => 'merchant',
        ]);

        CategoryType::factory()->create([
            'name' => 'product',
        ]);
    }
}
