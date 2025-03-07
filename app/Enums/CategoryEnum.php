<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum CategoryEnum: string
{
    use EnumHelper;

    case FOOD = 'food';
    case FRUITS = 'fruits';
    case VEGETABLES = 'vegetables';
    case WHOLE_GRAINS = 'whole grains';
    case LEGUMES = 'legumes';
    case NUTS = 'nuts';
    case SEEDS = 'seeds';

    case BEVERAGES = 'beverages';
    case ALCOHOLIC = 'alcoholic';
    case NON_ALCOHOLIC = 'non-alcoholic';
    case BEER = 'beer';
    case LIQUOR = 'liquor';
    case SODA = 'soda';
    case JUICE = 'juice';

    case CAFE = 'café';
    case RESTAURANT = 'restaurant';
    case MARKET = 'market';
    case FARMERS_MARKET = 'farmers market';
    case BILLS = 'bills';
    case ELECTRICITY = 'electricity';
    case INTERNET = 'internet';
    case PHONE = 'phone';
    case RENT = 'rent';
    case CANTEEN = 'canteen';
    case LAUNDRY = 'laundry';
    case WASHING = 'washing';
    case DRYING = 'drying';
    case HOUSING = 'housing';
}
