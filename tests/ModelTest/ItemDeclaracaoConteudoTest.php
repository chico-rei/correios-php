<?php

namespace ChicoRei\Packages\Correios\Tests\ModelTest;

use ChicoRei\Packages\Correios\Model\ItemDeclaracaoConteudo;
use PHPUnit\Framework\TestCase;

class ItemDeclaracaoConteudoTest extends TestCase
{
    /**
     * ItemDeclaracaoConteudo Test Data
     * @return array
     */
    public static function getTestData()
    {
        return [
            'conteudo' => 'Camiseta',
            'quantidade' => '2',
            'valor' => '79.90',
        ];
    }

    public function testToArray()
    {
        $item = ItemDeclaracaoConteudo::create(static::getTestData());
        $this->assertSame(static::getTestData(), $item->toArray());
    }

    public function testToArrayWithNullValues()
    {
        $item = ItemDeclaracaoConteudo::create();
        $this->assertSame([
            'conteudo' => null,
            'quantidade' => null,
            'valor' => null,
        ], $item->toArray());
    }
}
