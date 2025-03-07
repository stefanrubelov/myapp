<?php

namespace App\Helpers;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PaymentNumberGenerator
{
    /**
     * Generate a unique payment number in the format YYMM0000
     *
     * @return string
     */
    public static function generate(): string
    {
        $date = Carbon::now();
        $prefix = $date->format('ym');

        $latestPayment = Payment::where('payment_number', 'like', $prefix . '%')
            ->orderBy('payment_number', 'desc')
            ->first();

        if (!$latestPayment) {
            return $prefix . '00000';
        }

        $currentNumber = (int)substr($latestPayment->payment_number, -4);
        $nextNumber = str_pad($currentNumber + 10, 4, '0', STR_PAD_LEFT);

        return $prefix . $nextNumber;
    }
}
