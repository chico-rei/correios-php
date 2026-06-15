<?php

namespace ChicoRei\Packages\Correios\Tests;

use Carbon\Carbon;
use ChicoRei\Packages\Correios\Util;
use PHPUnit\Framework\TestCase;

class UtilTest extends TestCase
{
    public function testCleanArrayReturnsNullForNull()
    {
        $value = null;
        $this->assertNull(Util::cleanArray($value));
    }

    public function testCleanArrayRemovesNullValues()
    {
        $array = ['a' => 1, 'b' => null, 'c' => 'value'];

        $this->assertSame(['a' => 1, 'c' => 'value'], Util::cleanArray($array));
    }

    public function testCleanArrayRemovesNullValuesRecursively()
    {
        $array = [
            'a' => 1,
            'b' => [
                'c' => null,
                'd' => 'keep',
            ],
        ];

        $this->assertSame([
            'a' => 1,
            'b' => [
                'd' => 'keep',
            ],
        ], Util::cleanArray($array));
    }

    public function testCleanArrayKeepsFalsyNonNullValues()
    {
        $array = ['zero' => 0, 'empty' => '', 'false' => false, 'null' => null];

        $this->assertSame([
            'zero' => 0,
            'empty' => '',
            'false' => false,
        ], Util::cleanArray($array));
    }

    public function testParseDateReturnsNullForNull()
    {
        $this->assertNull(Util::parseDate(null));
    }

    public function testParseDateReturnsCarbonInstance()
    {
        $date = Util::parseDate('2024-12-25T10:30:00-03:00');

        $this->assertInstanceOf(Carbon::class, $date);
        $this->assertTrue(Carbon::parse('2024-12-25T10:30:00-03:00')->equalTo($date));
    }

    public function testParseDateUsesSaoPauloTimezoneForNaiveStrings()
    {
        $date = Util::parseDate('2024-12-25 10:30:00');

        $this->assertSame('America/Sao_Paulo', $date->getTimezone()->getName());
        $this->assertSame('2024-12-25 10:30:00', $date->format('Y-m-d H:i:s'));
    }

    /**
     * When the first Carbon::parse() throws, the catch block retries after
     * stripping the last 3 characters (the "remove nanoseconds" fallback).
     */
    public function testParseDateFallsBackByStrippingTrailingCharacters()
    {
        // The comma decimal separator makes the first parse throw; dropping
        // the trailing ",12" leaves a parseable "2024-12-25T10:30:00,".
        $date = Util::parseDate('2024-12-25T10:30:00,123');

        $this->assertInstanceOf(Carbon::class, $date);
        $this->assertTrue(
            Carbon::parse('2024-12-25T10:30:00', 'America/Sao_Paulo')->equalTo($date)
        );
    }
}
