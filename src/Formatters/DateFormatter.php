<?php

namespace StarInsure\PhpSdk\Formatters;

use Carbon\Exceptions\InvalidFormatException;
use DateTime;
use Illuminate\Support\Carbon;
use StarInsure\PhpSdk\Contracts\DateFormatter as Contract;

class DateFormatter implements Contract
{
    public function format(DateTime|Carbon|string|null $date, ?string $overrideFormatString = null): string
    {
        try {
            if (is_null($date) || $date === '') {
                return '';
            }

            $formatString = $overrideFormatString ?? 'd/m/Y';

            if ($date instanceof DateTime) {
                return $date->format($formatString);
            }

            /*
             * If date is a string, first attempt to parse it in non-standard formats
             * Only parse the first 10 characters of the string
             * dd/MM/yyyy, dd-MM-yyyy, dd.MM.yyyy
             */
            $nonStandardDate = str_replace(['-', '.'], '/', substr($date, 0, 10));

            $parsedDate = Carbon::createFromFormat('d/m/Y', $nonStandardDate);

            return $parsedDate->format($formatString);
        } catch (InvalidFormatException $error) {
            try {
                $parsedDate = Carbon::parse($date);

                return $parsedDate->format($formatString);
            } catch (InvalidFormatException $error) {
                return '';
            }
        }
    }
}
