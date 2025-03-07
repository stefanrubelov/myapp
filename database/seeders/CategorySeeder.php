<?php

namespace Database\Seeders;

use App\Enums\CategoryEnum;
use App\Enums\CategoryTypeEnum;
use App\Models\Category;
use App\Models\CategoryType;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get category types (merchant and product)
        $merchantType = CategoryType::where('name', CategoryTypeEnum::MERCHANT->value)->first();
        $productType = CategoryType::where('name', CategoryTypeEnum::PRODUCT->value)->first();

        // Create Food Parent Category
        $foodParent = Category::factory()->create([
            'name' => CategoryEnum::FOOD->value,
            'category_type_id' => $productType->id,
        ]);

        // Fruits Category
        $fruits = Category::factory()->create([
            'name' => CategoryEnum::FRUITS->value,
            'category_type_id' => $productType->id,
        ]);
        $fruits->parent()->associate($foodParent);
        $fruits->save();

        // Vegetables Category
        $vegetables = Category::factory()->create([
            'name' => CategoryEnum::VEGETABLES->value,
            'category_type_id' => $productType->id,
        ]);
        $vegetables->parent()->associate($foodParent);
        $vegetables->save();

        // Whole Grains Category
        $wholeGrains = Category::factory()->create([
            'name' => CategoryEnum::WHOLE_GRAINS->value,
            'category_type_id' => $productType->id,
        ]);
        $wholeGrains->parent()->associate($foodParent);
        $wholeGrains->save();

        // Legumes Category
        $legumes = Category::factory()->create([
            'name' => CategoryEnum::LEGUMES->value,
            'category_type_id' => $productType->id,
        ]);
        $legumes->parent()->associate($foodParent);
        $legumes->save();

        // Nuts and Seeds Category
        $nuts = Category::factory()->create([
            'name' => CategoryEnum::NUTS->value,
            'category_type_id' => $productType->id,
        ]);
        $nuts->parent()->associate($foodParent);
        $nuts->save();

        $seeds = Category::factory()->create([
            'name' => CategoryEnum::SEEDS->value,
            'category_type_id' => $productType->id,
        ]);
        $seeds->parent()->associate($foodParent);
        $seeds->save();

        // Beverages Category
        $beverages = Category::factory()->create([
            'name' => CategoryEnum::BEVERAGES->value,
            'category_type_id' => $productType->id,
        ]);
        $beverages->parent()->associate($foodParent);
        $beverages->save();

        // Add Alcoholic and Non-Alcoholic Beverages
        $alcoholic = Category::factory()->create([
            'name' => CategoryEnum::ALCOHOLIC->value,
            'category_type_id' => $productType->id,
        ]);
        $alcoholic->parent()->associate($beverages);
        $alcoholic->save();

        $nonAlcoholic = Category::factory()->create([
            'name' => CategoryEnum::NON_ALCOHOLIC->value,
            'category_type_id' => $productType->id,
        ]);
        $nonAlcoholic->parent()->associate($beverages);
        $nonAlcoholic->save();

        // Alcoholic beverages (under Alcoholic)
        Category::factory()->create([
            'name' => CategoryEnum::BEER->value,
            'category_type_id' => $productType->id,
        ])->parent()->associate($alcoholic)->save();

        Category::factory()->create([
            'name' => CategoryEnum::LIQUOR->value,
            'category_type_id' => $productType->id,
        ])->parent()->associate($alcoholic)->save();

        // Non-Alcoholic beverages (under Non-Alcoholic)
        Category::factory()->create([
            'name' => CategoryEnum::SODA->value,
            'category_type_id' => $productType->id,
        ])->parent()->associate($nonAlcoholic)->save();

        Category::factory()->create([
            'name' => CategoryEnum::JUICE->value,
            'category_type_id' => $productType->id,
        ])->parent()->associate($nonAlcoholic)->save();

        $marketParent = Category::factory()->create([
            'name' => CategoryEnum::MARKET->value,
            'category_type_id' => $merchantType->id,
        ]);

        Category::factory()->create([
            'name' => CategoryEnum::FARMERS_MARKET->value,
            'category_type_id' => $merchantType->id,
        ])->parent()->associate($marketParent)->save();

        // Create Bills Parent Category
        $billsParent = Category::factory()->create([
            'name' => CategoryEnum::BILLS->value,
            'category_type_id' => $merchantType->id,
        ]);

        // Subcategories for Bills (Electricity, Internet, Phone, etc.)
        Category::factory()->create([
            'name' => CategoryEnum::ELECTRICITY->value,
            'category_type_id' => $merchantType->id,
        ])->parent()->associate($billsParent)->save();

        Category::factory()->create([
            'name' => CategoryEnum::INTERNET->value,
            'category_type_id' => $merchantType->id,
        ])->parent()->associate($billsParent)->save();

        Category::factory()->create([
            'name' => CategoryEnum::PHONE->value,
            'category_type_id' => $merchantType->id,
        ])->parent()->associate($billsParent)->save();


        Category::factory()->create([
            'name' => CategoryEnum::CAFE->value,
            'category_type_id' => $merchantType->id,
        ]);

        $restaurantParent = Category::factory()->create([
            'name' => CategoryEnum::RESTAURANT->value,
            'category_type_id' => $merchantType->id,
        ]);

        Category::factory()->create([
            'name' => CategoryEnum::CANTEEN->value,
            'category_type_id' => $merchantType->id,
        ])->parent()->associate($restaurantParent)->save();

        $housingParent = Category::factory()->create([
            'name' => CategoryEnum::HOUSING->value,
            'category_type_id' => $productType->id,
        ]);

        Category::factory()->create([
            'name' => CategoryEnum::RENT->value,
            'category_type_id' => $productType->id,
        ])->parent()->associate($housingParent)->save();

        $laundryParent = Category::factory()->create([
            'name' => CategoryEnum::LAUNDRY->value,
            'category_type_id' => $productType->id,
            'parent_id' => $housingParent->id,
        ]);

        Category::factory()->create([
            'name' => CategoryEnum::WASHING->value,
            'category_type_id' => $productType->id,
        ])->parent()->associate($laundryParent)->save();

        Category::factory()->create([
            'name' => CategoryEnum::DRYING->value,
            'category_type_id' => $productType->id,
        ])->parent()->associate($laundryParent)->save();
    }
}
