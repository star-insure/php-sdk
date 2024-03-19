<?php

use Carbon\Carbon;
use StarInsure\PhpSdk\Contracts\DateFormatter;
use StarInsure\PhpSdk\Contracts\DateTimeFormatter;
use StarInsure\PhpSdk\Contracts\MoneyFormatter;

if (! function_exists('formatMoney')) {
    function formatMoney(float|int|string|null $value, ?int $decimalPlaces = 2)
    {
        return app(MoneyFormatter::class)->format($value, $decimalPlaces);
    }
}

if (! function_exists('formatDate')) {
    function formatDate(DateTime|Carbon|string|null $date, ?string $overrideFormatString = null)
    {
        return app(DateFormatter::class)->format($date, $overrideFormatString);
    }
}

if (! function_exists('formatDateTime')) {
    function formatDateTime(DateTime|Carbon|string|null $date, ?string $overrideFormatString = null)
    {
        return app(DateTimeFormatter::class)->format($date, $overrideFormatString);
    }
}
