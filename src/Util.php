<?php

namespace ChicoRei\Packages\Correios;

class Util
{
    /**
     * Remove all null values from array
     */
    public static function cleanArray(?array &$array): ?array
    {
        if (is_null($array)) {
            return null;
        }

        foreach ($array as $key => &$value) {
            if (is_null($value)) {
                unset($array[$key]);
            } else {
                if (is_array($value)) {
                    Util::cleanArray($value);
                }
            }
        }

        return $array;
    }

    /**
     * Return equivalent amount in cents
     */
    public static function amountInCents(?float $amount): int
    {
        return $amount ? intval(number_format($amount, 2, '', '')) : 0;
    }
}
