<?php

declare(strict_types=1);

namespace App\Domains\Expenses\Payment\Helpers;

use App\Domains\Expenses\Payment\Model\Payment;
use Carbon\Carbon;

class PaymentNumberGenerator
{
    /**
     * Generate a unique payment number in the format YYYYMMDD00000
     */
    public static function generate(): string
    {
        $date = Carbon::now();
        $prefix = $date->format('Ymd');

        $latestPayment = Payment::where('payment_number', 'like', $prefix.'%')
            ->orderBy('payment_number', 'desc')
            ->first();

        if (! $latestPayment) {
            return $prefix.'00000';
        }

        $lastPart = substr($latestPayment->payment_number, strlen($prefix));

        if (strlen($lastPart) === 5 && (int) $lastPart >= 99990) {
            return $prefix.'000000';
        }

        $currentNumber = (int) $lastPart;
        $nextNumber = str_pad((string) ($currentNumber + 10), strlen($lastPart), '0', STR_PAD_LEFT);

        return $prefix.$nextNumber;
    }
}
