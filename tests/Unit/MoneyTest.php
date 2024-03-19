<?php

use StarInsure\PhpSdk\Formatters\MoneyFormatter;

function fm($value): string
{
    return (new MoneyFormatter)->format($value);
}

describe('format money', function () {
    it('can format 0 to $0.00', function () {
        expect(fm(0))->toBe('$0.00');
    });

    it('can format 123 to $123.00', function () {
        expect(fm(123))->toBe('$123.00');
    });

    it('can format 123456.789 to $123,456.79', function () {
        expect(fm(123456.789))->toBe('$123,456.79');
    });

    it('can format 789123456.789 to $789,123,456.79', function () {
        expect(fm(789123456.789))->toBe('$789,123,456.79');
    });

    it('can format string 789123456.789 to $789,123,456.79', function () {
        expect(fm('789123456.789'))->toBe('$789,123,456.79');
    });

    it('can format -123 to - $123.00', function () {
        expect(fm(-123))->toBe('- $123.00');
    });

    it('can format -123456.789 to - $123,456.79', function () {
        expect(fm(-123456.789))->toBe('- $123,456.79');
    });

    it('can format -789123456.789 to - $789,123,456.79', function () {
        expect(fm(-789123456.789))->toBe('- $789,123,456.79');
    });

    it('can format string -789123456.789 to - $789,123,456.79', function () {
        expect(fm('-789123456.789'))->toBe('- $789,123,456.79');
    });

    it('can return $0.00 for invalid input', function () {
        expect(fm('abc'))->toBe('$0.00');
        expect(fm(' '))->toBe('$0.00');
    });

    it('can return empty string for null input', function () {
        expect(fm(null))->toBe('');
    });
});
