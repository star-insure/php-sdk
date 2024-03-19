<?php

namespace StarInsure\PhpSdk\Formatters;

use StarInsure\PhpSdk\Contracts\MoneyFormatter as Contract;

class MoneyFormatter implements Contract
{
    public function format(float|int|string|null $value, ?int $decimalPlaces = 2): string
    {
        if (is_null($value) || $value === '') {
            return '';
        }

        if (is_string($value)) {
            $value = preg_replace('/[^\d.-]/', '', $value);
        }

        return str_replace('$-', '- $', '$'.number_format((float) $value, $decimalPlaces, '.', ','));
    }
}
