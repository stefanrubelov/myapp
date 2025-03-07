<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum PaymentMethodEnum: string
{
    use EnumHelper;

    case CARD = 'card';
    case MOBILE_PAY = 'mobile pay';
    case CASH = 'cash';
    case BANK_TRANSFER = 'bank transfer';
}
