<?php

namespace App\Enums;

use App\Traits\EnumHelper;

enum TransactionTypeEnum: string
{
    use EnumHelper;

    case OUTGOING = 'outgoing';
    case INCOMING = 'incoming';
}
