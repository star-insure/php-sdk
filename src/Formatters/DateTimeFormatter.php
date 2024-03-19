<?php

namespace StarInsure\PhpSdk\Formatters;

use Carbon\Exceptions\InvalidFormatException;
use DateTime;
use Illuminate\Support\Carbon;
use StarInsure\PhpSdk\Contracts\DateTimeFormatter as Contract;

class DateTimeFormatter implements Contract
{
    public function format(DateTime|Carbon|string|null $dateTime, ?string $overrideFormatString = null): string
    {
        try {
            if (is_null($dateTime) || $dateTime === '') {
                return '';
            }

            $formatString = $overrideFormatString ?? 'd/m/Y H:i';

            if ($dateTime instanceof DateTime) {
                return $dateTime->format($formatString);
            }

            /*
             * If date is a string, first attempt to parse it in non-standard formats
             * dd/MM/yyyy HH:mm, dd-MM-yyyy HH:mm, dd.MM.yyyy HH:mm,
             * dd/MM/yyyy hh:mm a, dd-MM-yyyy hh:mm a, dd.MM.yyyy hh:mm a,
             * dd/MM/yyyy HH:mm:ss, dd-MM-yyyy HH:mm:ss, dd.MM.yyyy HH:mm:ss,
             * dd/MM/yyyy hh:mm:ss a, dd-MM-yyyy hh:mm:ss a, dd.MM.yyyy hh:mm:ss a
             */
            // Remove commas between date and time
            // Only parse the first 22 characters of the string
            $nonStandardDateTime = str_replace(',', '', substr($dateTime, 0, 22));

            // Replace dashes and dots with slashes
            $nonStandardDateTime = str_replace(['-', '.'], '/', $nonStandardDateTime);

            $is12Hour = collect(['AM', 'PM'])->contains(strtoupper(substr($nonStandardDateTime, -2)));
            $hasSeconds = count(explode(':', $nonStandardDateTime)) === 3;

            $nonStandardFormat = trim('d/m/Y '.($is12Hour ? 'h' : 'H').':i'.($hasSeconds ? ':s' : '').' '.($is12Hour ? 'a' : ''));

            $parsedDateTime = Carbon::createFromFormat($nonStandardFormat, $nonStandardDateTime);

            return $parsedDateTime->format($formatString);
        } catch (InvalidFormatException $error) {
            try {
                $parsedDate = Carbon::parse($dateTime);

                return $parsedDate->format($formatString);
            } catch (InvalidFormatException $error) {
                return '';
            }
        }
    }
}
