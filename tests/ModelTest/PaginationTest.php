<?php

namespace ChicoRei\Packages\Correios\Tests\ModelTest;

use ChicoRei\Packages\Correios\Model\Pagination;
use PHPUnit\Framework\TestCase;

class PaginationTest extends TestCase
{
    /**
     * Pagination Test Data
     * @return array
     */
    public static function getTestData()
    {
        return [
            'size' => 10,
            'numberElements' => 5,
            'totalPages' => 3,
            'number' => 1,
            'count' => 25,
            'next' => true,
            'previous' => false,
            'first' => true,
            'last' => false,
        ];
    }

    public function testToArray()
    {
        $pagination = Pagination::create(static::getTestData());
        $this->assertSame(static::getTestData(), $pagination->toArray());
    }

    public function testBooleanGettersPreserveType()
    {
        $pagination = Pagination::create(static::getTestData());
        $this->assertTrue($pagination->getNext());
        $this->assertFalse($pagination->getLast());
        $this->assertIsInt($pagination->getSize());
    }

    public function testToArrayWithNullValues()
    {
        $pagination = Pagination::create();
        $this->assertSame([
            'size' => null,
            'numberElements' => null,
            'totalPages' => null,
            'number' => null,
            'count' => null,
            'next' => null,
            'previous' => null,
            'first' => null,
            'last' => null,
        ], $pagination->toArray());
    }
}
