<?php

declare(strict_types=1);

namespace App\Domains\Expenses\TransactionType\Enums;

use App\Traits\EnumHelper;

enum TransactionTypeEnum: string
{
    use EnumHelper;

    case OUTGOING = 'outgoing';
    case INCOMING = 'incoming';
}
