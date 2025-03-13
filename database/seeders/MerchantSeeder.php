<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Domains\Expenses\Category\Enums\CategoryEnum;
use App\Domains\Expenses\Category\Models\Category;
use App\Domains\Expenses\Merchant\Models\Merchant;
use Illuminate\Database\Seeder;

class MerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $marketCategory = Category::where('slug', CategoryEnum::MARKET->value)->first();
        $canteenCategory = Category::where('slug', CategoryEnum::CANTEEN->value)->first();
        $electricityCategory = Category::where('slug', CategoryEnum::ELECTRICITY->value)->first();
        $internetCategory = Category::where('slug', CategoryEnum::INTERNET->value)->first();
        $phoneCategory = Category::where('slug', CategoryEnum::PHONE->value)->first();
        $housingCategory = Category::where('slug', CategoryEnum::HOUSING->value)->first();

        Merchant::create([
            'name' => 'REMA 1000',
            'category_id' => $marketCategory->id,
            'accent_color' => '#1c4378',
        ]);

        Merchant::create([
            'name' => 'Fotex',
            'category_id' => $marketCategory->id,
            'accent_color' => '#1d2f54',
        ]);

        Merchant::create([
            'name' => 'Netto',
            'category_id' => $marketCategory->id,
            'accent_color' => '#fad85b',
        ]);

        Merchant::create([
            'name' => 'Meny',
            'category_id' => $marketCategory->id,
            'accent_color' => '#ce0029',
        ]);

        Merchant::create([
            'name' => 'EASV',
            'category_id' => $canteenCategory->id,
            'accent_color' => '#fdb93b',
        ]);

        Merchant::create([
            'name' => 'EWII',
            'category_id' => $electricityCategory->id,
            'accent_color' => '#00afaa',
        ]);

        Merchant::create([
            'name' => 'Telia',
            'category_id' => $internetCategory->id,
            'accent_color' => '#990ae3',
        ]);

        Merchant::create([
            'name' => 'Lebara',
            'category_id' => $phoneCategory->id,
            'accent_color' => '#84d7fc',
        ]);

        Merchant::create([
            'name' => 'Domea',
            'category_id' => $housingCategory->id,
            'accent_color' => '#005448',
        ]);
    }
}
