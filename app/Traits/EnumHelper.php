<?php

declare(strict_types=1);

namespace App\Traits;

trait EnumHelper
{
    /**
     * Get an array of all cases and their values
     */
    public static function values(): array
    {
        $cases = self::cases();

        return array_map(fn ($case) => $case->value, $cases);
    }

    /**
     * Get an array of case names as keys and their values
     */
    public static function toArray(): array
    {
        $cases = self::cases();

        return array_reduce($cases, function ($carry, $case) {
            $carry[$case->name] = $case->value;

            return $carry;
        }, []);
    }

    /**
     * Get an array suitable for form select options
     */
    public static function forSelect(): array
    {
        $cases = self::cases();

        return array_map(fn ($case) => [
            'value' => $case->value,
            'label' => str_replace('_', ' ', $case->name),
        ], $cases);
    }

    /**
     * Check if a value exists in the enum
     */
    public static function hasValue(mixed $value): bool
    {
        return in_array($value, self::values(), true);
    }
}
