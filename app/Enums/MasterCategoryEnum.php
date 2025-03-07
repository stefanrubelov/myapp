<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum MasterCategoryEnum: string
{
    use EnumHelper;

    case GROCERY = 'grocery';
    case BILL = 'bill';
    case SUBSCRIPTION = 'subscription';
    case RENT = 'rent';
    case INVOICE = 'invoice';
    CASE RESTAURANT = 'restaurant';
}
