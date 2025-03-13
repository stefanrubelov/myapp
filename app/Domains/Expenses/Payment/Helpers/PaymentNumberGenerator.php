<?php

declare(strict_types=1);

namespace App\Domains\Expenses\Payment\Helpers;

use App\Domains\Expenses\Payment\Model\Payment;
use Carbon\Carbon;

class PaymentNumberGenerator
{
    /**
     * Generate a unique payment number in the format YYMM0000
     */
    public static function generate(): string
    {
        $date = Carbon::now();
        $prefix = $date->format('ym');

        $latestPayment = Payment::where('payment_number', 'like', $prefix.'%')
            ->orderBy('payment_number', 'desc')
            ->first();

        if (! $latestPayment) {
            return $prefix.'00000';
        }

        $currentNumber = (int) substr($latestPayment->payment_number, -4);
        $nextNumber = str_pad((string) $currentNumber, 4, '0', STR_PAD_LEFT);

        return $prefix.$nextNumber;
    }
}
