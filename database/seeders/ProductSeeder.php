<?php

namespace Database\Seeders;

use App\Enums\CategoryEnum;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get categories by slug
        $fruitsCategory = Category::where('slug', CategoryEnum::FRUITS->value)->first();
        $vegetablesCategory = Category::where('slug', CategoryEnum::VEGETABLES->value)->first();
        $wholeGrainsCategory = Category::where('slug', Str::replace(" ", "-", CategoryEnum::WHOLE_GRAINS->value))->first();
        $legumesCategory = Category::where('slug', CategoryEnum::LEGUMES->value)->first();
        $nutsAndSeedsCategory = Category::where('slug', CategoryEnum::NUTS->value)->first();
        $seeds = Category::where('slug', CategoryEnum::SEEDS->value)->first();
        $beveragesCategory = Category::where('slug', CategoryEnum::BEVERAGES->value)->first();
        $alcoholicCategory = Category::where('slug', CategoryEnum::ALCOHOLIC->value)->first();
        $nonAlcoholicCategory = Category::where('slug', CategoryEnum::NON_ALCOHOLIC->value)->first();
        $marketCategory = Category::where('slug', CategoryEnum::MARKET->value)->first();
        $billsCategory = Category::where('slug', CategoryEnum::BILLS->value)->first();
        $rentCategory = Category::where('slug', CategoryEnum::RENT->value)->first();
        $canteenCategory = Category::where('slug', CategoryEnum::CANTEEN->value)->first();

        // Prepare all products in an array for mass insert
        $products = [];

        // Fruits (5 items)
        $products[] = ['name' => 'Apple', 'category_id' => $fruitsCategory->id];
        $products[] = ['name' => 'Banana', 'category_id' => $fruitsCategory->id];
        $products[] = ['name' => 'Blueberries', 'category_id' => $fruitsCategory->id];
        $products[] = ['name' => 'Grapes', 'category_id' => $fruitsCategory->id];
        $products[] = ['name' => 'Orange', 'category_id' => $fruitsCategory->id];

        // Vegetables (5 items)
        $products[] = ['name' => 'Carrot', 'category_id' => $vegetablesCategory->id];
        $products[] = ['name' => 'Broccoli', 'category_id' => $vegetablesCategory->id];
        $products[] = ['name' => 'Spinach', 'category_id' => $vegetablesCategory->id];
        $products[] = ['name' => 'Cauliflower', 'category_id' => $vegetablesCategory->id];
        $products[] = ['name' => 'Cucumber', 'category_id' => $vegetablesCategory->id];

        // Whole Grains (6 items)
        $products[] = ['name' => 'Brown Rice', 'category_id' => $wholeGrainsCategory->id];
        $products[] = ['name' => 'Quinoa', 'category_id' => $wholeGrainsCategory->id];
        $products[] = ['name' => 'Oats', 'category_id' => $wholeGrainsCategory->id];
        $products[] = ['name' => 'Barley', 'category_id' => $wholeGrainsCategory->id];
        $products[] = ['name' => 'Buckwheat', 'category_id' => $wholeGrainsCategory->id];
        $products[] = ['name' => 'Millet', 'category_id' => $wholeGrainsCategory->id];

        // Legumes (6 items)
        $products[] = ['name' => 'Lentils', 'category_id' => $legumesCategory->id];
        $products[] = ['name' => 'Chickpeas', 'category_id' => $legumesCategory->id];
        $products[] = ['name' => 'Black Beans', 'category_id' => $legumesCategory->id];
        $products[] = ['name' => 'Peas', 'category_id' => $legumesCategory->id];
        $products[] = ['name' => 'Kidney Beans', 'category_id' => $legumesCategory->id];
        $products[] = ['name' => 'Soybeans', 'category_id' => $legumesCategory->id];

        // Nuts and Seeds (6 items)
        $products[] = ['name' => 'Almonds', 'category_id' => $nutsAndSeedsCategory->id];
        $products[] = ['name' => 'Walnuts', 'category_id' => $nutsAndSeedsCategory->id];
        $products[] = ['name' => 'Sunflower Seeds', 'category_id' => $nutsAndSeedsCategory->id];
        $products[] = ['name' => 'Chia Seeds', 'category_id' => $nutsAndSeedsCategory->id];
        $products[] = ['name' => 'Flaxseeds', 'category_id' => $nutsAndSeedsCategory->id];
        $products[] = ['name' => 'Pumpkin Seeds', 'category_id' => $nutsAndSeedsCategory->id];

        // Alcoholic Beverages (5 items)
        $products[] = ['name' => 'Beer', 'category_id' => $alcoholicCategory->id];
        $products[] = ['name' => 'Whiskey', 'category_id' => $alcoholicCategory->id];
        $products[] = ['name' => 'Wine', 'category_id' => $alcoholicCategory->id];
        $products[] = ['name' => 'Vodka', 'category_id' => $alcoholicCategory->id];
        $products[] = ['name' => 'Rum', 'category_id' => $alcoholicCategory->id];

        // Non-Alcoholic Beverages (6 items)
        $products[] = ['name' => 'Soda', 'category_id' => $nonAlcoholicCategory->id];
        $products[] = ['name' => 'Juice', 'category_id' => $nonAlcoholicCategory->id];
        $products[] = ['name' => 'Water', 'category_id' => $nonAlcoholicCategory->id];
        $products[] = ['name' => 'Tea', 'category_id' => $nonAlcoholicCategory->id];
        $products[] = ['name' => 'Lemonade', 'category_id' => $nonAlcoholicCategory->id];
        $products[] = ['name' => 'Iced Tea', 'category_id' => $nonAlcoholicCategory->id];

        // Market Products (5 items)
        $products[] = ['name' => 'Grocery', 'category_id' => $marketCategory->id];
        $products[] = ['name' => 'Spices', 'category_id' => $marketCategory->id];
        $products[] = ['name' => 'Meats', 'category_id' => $marketCategory->id];
        $products[] = ['name' => 'Dairy', 'category_id' => $marketCategory->id];
        $products[] = ['name' => 'Frozen Foods', 'category_id' => $marketCategory->id];

        // Bills Products (4 items)
        $products[] = ['name' => 'Electricity Bill', 'category_id' => $billsCategory->id];
        $products[] = ['name' => 'Internet Bill', 'category_id' => $billsCategory->id];
        $products[] = ['name' => 'Phone Bill', 'category_id' => $billsCategory->id];
        $products[] = ['name' => 'Gas Bill', 'category_id' => $billsCategory->id];

        // Rent Product
        $products[] = ['name' => 'Monthly Rent', 'category_id' => $rentCategory->id];

        // Canteen Products (2 items)
        $products[] = ['name' => 'Lunch Meal', 'category_id' => $canteenCategory->id];
        $products[] = ['name' => 'Snack', 'category_id' => $canteenCategory->id];

        // Insert all products at once using mass insert
        foreach ($products as $product) {
            Product::factory()->create($product);
        }
    }
}
