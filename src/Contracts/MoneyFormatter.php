<?php

namespace StarInsure\PhpSdk\Contracts;

interface MoneyFormatter
{
    public function format(int|float|string|null $value, ?int $decimalPlaces = 2): string;
}
