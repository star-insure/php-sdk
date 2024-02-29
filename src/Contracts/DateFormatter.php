<?php

namespace StarInsure\PhpSdk\Contracts;

use DateTime;
use Illuminate\Support\Carbon;

interface DateFormatter
{
    public function format(DateTime|Carbon|string|null $date, ?string $overrideFormatString = null): string;
}
