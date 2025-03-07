<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum CategoryTypeEnum: string
{
    use EnumHelper;

    case MERCHANT = 'merchant';
    case PRODUCT = 'product';
}
