<?php

namespace ChicoRei\Packages\Correios\Tests\ModelTest;

use ChicoRei\Packages\Correios\Model\FaixaCaixaPostal;
use PHPUnit\Framework\TestCase;

class FaixaCaixaPostalTest extends TestCase
{
    /**
     * FaixaCaixaPostal Test Data
     * @return array
     */
    public static function getTestData()
    {
        return [
            'nuInicial' => 1,
            'nuFinal' => 2,
        ];
    }

    public function testToArray()
    {
        $additionalData = FaixaCaixaPostal::create(static::getTestData());
        $this->assertSame(static::getTestData(), $additionalData->toArray());
    }
}
