<?php

declare(strict_types=1);

namespace App\Domains\Expenses\PaymentMethod\Enums;

use App\Domains\Shared\Traits\EnumHelper;

enum PaymentMethodEnum: string
{
    use EnumHelper;

    case CARD = 'card';
    case MOBILE_PAY = 'mobile pay';
    case CASH = 'cash';
    case BANK_TRANSFER = 'bank transfer';
}
