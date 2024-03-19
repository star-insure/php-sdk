<?php

use Carbon\Carbon;
use StarInsure\PhpSdk\Formatters\DateFormatter;
use StarInsure\PhpSdk\Formatters\DateTimeFormatter;

function fd($value): string
{
    return (new DateFormatter)->format($value);
}

function fdt($value): string
{
    return (new DateTimeFormatter)->format($value);
}

describe('dates', function () {
    it('can format DateTime to Star Insure standard format', function () {
        $dateObj = new DateTime('2024-02-23');
        $expected = '23/02/2024';

        expect(fd($dateObj))->toBe($expected);
    });

    it('can format null date to empty string', function () {
        $dateObj = null;
        $expected = '';

        expect(fd($dateObj))->toBe($expected);
    });

    it('can format ISO date string to Star Insure standard format', function () {
        $dateObj = '2024-03-23T20:00:00.000Z';
        $expected = '23/03/2024';

        expect(fd($dateObj))->toBe($expected);
    });

    it('can format UTC date string to Star Insure standard format', function () {
        $dateObj = 'Sat, 23 Mar 2024 20:00:00 GMT';
        $expected = '23/03/2024';

        expect(fd($dateObj))->toBe($expected);
    });

    it('can format date string even when its Star Insure standard format', function () {
        $dateObj = '23/03/2024, 8:00:00 PM';
        $expected = '23/03/2024';

        expect(fd($dateObj))->toBe($expected);
    });

    it('can format Carbon instance', function () {
        $dateObj = Carbon::create(2024, 3, 23);
        $expected = '23/03/2024';

        expect(fd($dateObj))->toBe($expected);
    });

    it('can convert date string of format 1 dd/MM/YYYY to Star Insure standard format', function () {
        $dateObj = '23/03/2024';
        $expected = '23/03/2024';

        expect(fd($dateObj))->toBe($expected);
    });

    it('can convert date string of format 2 dd-MM-YYYY to Star Insure standard format', function () {
        $dateObj = '23-03-2024';
        $expected = '23/03/2024';

        expect(fd($dateObj))->toBe($expected);
    });

    it('can convert date string of format 3 dd.MM.YYYY to Star Insure standard format', function () {
        $dateObj = '23.03.2024';
        $expected = '23/03/2024';

        expect(fd($dateObj))->toBe($expected);
    });

    it('can return empty string if date string is invalid', function () {
        $dateObj = '02 - 05 - 2024 08:00 PM';
        $expected = '';

        expect(fd($dateObj))->toBe($expected);
    });

    it('can format date with single digit day and month', function () {
        $dateObj = '2/3/2024';
        $expected = '02/03/2024';

        expect(fd($dateObj))->toBe($expected);
    });
});

describe('dateTime', function() {
    it('can format DateTime to Star Insure standard format', function () {
        $dateObj = new DateTime('2024-02-23 20:00:00');
        $expected = '23/02/2024 20:00';

        expect(fdt($dateObj, true))->toBe($expected);
    });

    it('can format null date to empty string', function () {
        $dateObj = null;
        $expected = '';

        expect(fdt($dateObj, true))->toBe($expected);
    });

    it('can format ISO date string to Star Insure standard format', function () {
        $dateObj = '2024-03-23T20:00:00.000Z';
        $expected = '23/03/2024 20:00';

        expect(fdt($dateObj, true))->toBe($expected);
    });

    it('can format UTC date string to Star Insure standard format', function () {
        $dateObj = 'Sat, 23 Mar 2024 20:00:00 GMT';
        $expected = '23/03/2024 20:00';

        expect(fdt($dateObj, true))->toBe($expected);
    });

    it('can format date string even when its Star Insure standard format', function () {
        $dateObj = '23/03/2024, 8:00:00 PM';
        $expected = '23/03/2024 20:00';

        expect(fdt($dateObj, true))->toBe($expected);
    });

    it('can format Carbon instance', function () {
        $dateObj = Carbon::create(2024, 3, 23, 20, 0, 0);
        $expected = '23/03/2024 20:00';

        expect(fdt($dateObj, true))->toBe($expected);
    });

    it('can convert date string of format 1 dd/MM/YYYY to Star Insure standard format', function () {
        $dateObj = '23/03/2024 20:00:00';
        $expected = '23/03/2024 20:00';

        expect(fdt($dateObj, true))->toBe($expected);
    });

    it('can convert date string of format 2 dd-MM-YYYY to Star Insure standard format', function () {
        $dateObj = '23-03-2024 20:00:00';
        $expected = '23/03/2024 20:00';

        expect(fdt($dateObj, true))->toBe($expected);
    });

    it('can convert date string of format 3 dd.MM.YYYY to Star Insure standard format', function () {
        $dateObj = '23.03.2024 20:00:00';
        $expected = '23/03/2024 20:00';

        expect(fdt($dateObj, true))->toBe($expected);
    });

    it('can return empty string if date string is invalid', function () {
        $dateObj = '02 - 05 - 2024 08:00 PM';
        $expected = '';

        expect(fdt($dateObj, true))->toBe($expected);
    });

    it('can format date with single digit day and month', function () {
        $dateObj = '2/3/2024 20:00:00';
        $expected = '02/03/2024 20:00';

        expect(fdt($dateObj, true))->toBe($expected);
    });
});