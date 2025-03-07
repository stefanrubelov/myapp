<?php

namespace Database\Seeders;

use App\Enums\MasterCategoryEnum;
use App\Models\MasterCategory;
use Illuminate\Database\Seeder;

class MasterCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (MasterCategoryEnum::values() as $category) {
            MasterCategory::create([
                'name' => $category,
            ]);
        }
    }
}
