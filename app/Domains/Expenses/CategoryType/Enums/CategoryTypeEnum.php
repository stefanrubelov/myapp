<?php

declare(strict_types=1);

namespace App\Domains\Expenses\CategoryType\Enums;

use App\Domains\Shared\Traits\EnumHelper;

enum CategoryTypeEnum: string
{
    use EnumHelper;

    case MERCHANT = 'merchant';
    case PRODUCT = 'product';
}
