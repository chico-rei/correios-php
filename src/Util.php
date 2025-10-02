<?php

namespace ChicoRei\Packages\Correios;

use Carbon\Carbon;

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
    public static function parseDate($dateToParse)
    {
        if (is_null($dateToParse)) {
            return null;
        }

        try {
            return Carbon::parse($dateToParse, 'America/Sao_Paulo');
        } catch (\Exception $e) {
            // Try to remove nanoseconds
            return Carbon::parse(mb_substr($dateToParse, 0, -3), 'America/Sao_Paulo');
        }
    }
}
