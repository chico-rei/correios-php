<?php

namespace ChicoRei\Packages\Correios\Tests\ModelTest;

use ChicoRei\Packages\Correios\Model\MalotePrePostagem;
use PHPUnit\Framework\TestCase;

class MalotePrePostagemTest extends TestCase
{
    /**
     * MalotePrePostagem Test Data
     * @return array
     */
    public static function getTestData()
    {
        return [
            'numeroMalote' => '123456',
        ];
    }

    public function testToArray()
    {
        $malote = MalotePrePostagem::create(static::getTestData());
        $this->assertSame(static::getTestData(), $malote->toArray());
    }

    public function testToArrayWithNullValues()
    {
        $malote = MalotePrePostagem::create();
        $this->assertSame(['numeroMalote' => null], $malote->toArray());
    }
}
