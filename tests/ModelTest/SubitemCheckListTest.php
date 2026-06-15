<?php

namespace ChicoRei\Packages\Correios\Tests\ModelTest;

use ChicoRei\Packages\Correios\Model\SubitemCheckList;
use PHPUnit\Framework\TestCase;

class SubitemCheckListTest extends TestCase
{
    /**
     * SubitemCheckList Test Data
     * @return array
     */
    public static function getTestData()
    {
        return [
            'codigo' => '01',
        ];
    }

    public function testToArray()
    {
        $subitem = SubitemCheckList::create(static::getTestData());
        $this->assertSame(static::getTestData(), $subitem->toArray());
    }

    public function testToArrayWithNullValues()
    {
        $subitem = SubitemCheckList::create();
        $this->assertSame(['codigo' => null], $subitem->toArray());
    }

    public function testFluentSetterReturnsSelf()
    {
        $subitem = new SubitemCheckList();
        $this->assertSame($subitem, $subitem->setCodigo('05'));
        $this->assertSame('05', $subitem->getCodigo());
    }
}
