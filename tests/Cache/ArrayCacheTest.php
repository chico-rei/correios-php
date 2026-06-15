<?php

namespace ChicoRei\Packages\Correios\Tests\Cache;

use ChicoRei\Packages\Correios\Cache\ArrayCache;
use DateInterval;
use PHPUnit\Framework\TestCase;

class ArrayCacheTest extends TestCase
{
    public function testGetReturnsDefaultWhenMissing()
    {
        $cache = new ArrayCache();

        $this->assertNull($cache->get('missing'));
        $this->assertSame('fallback', $cache->get('missing', 'fallback'));
    }

    public function testSetGetAndHas()
    {
        $cache = new ArrayCache();

        $this->assertFalse($cache->has('key'));
        $this->assertTrue($cache->set('key', 'value'));
        $this->assertTrue($cache->has('key'));
        $this->assertSame('value', $cache->get('key'));
    }

    public function testDelete()
    {
        $cache = new ArrayCache();
        $cache->set('key', 'value');

        $this->assertTrue($cache->delete('key'));
        $this->assertFalse($cache->has('key'));
    }

    public function testClear()
    {
        $cache = new ArrayCache();
        $cache->set('a', 1);
        $cache->set('b', 2);

        $this->assertTrue($cache->clear());
        $this->assertFalse($cache->has('a'));
        $this->assertFalse($cache->has('b'));
    }

    public function testMultipleOperations()
    {
        $cache = new ArrayCache();

        $this->assertTrue($cache->setMultiple(['a' => 1, 'b' => 2]));
        $this->assertSame(['a' => 1, 'b' => 2], $cache->getMultiple(['a', 'b']));
        $this->assertSame(
            ['a' => 1, 'missing' => 'def'],
            $cache->getMultiple(['a', 'missing'], 'def')
        );

        $this->assertTrue($cache->deleteMultiple(['a', 'b']));
        $this->assertFalse($cache->has('a'));
        $this->assertFalse($cache->has('b'));
    }

    public function testExpiredEntryIsEvicted()
    {
        $cache = new ArrayCache();
        // Negative TTL puts expiration in the past, so has() should evict it.
        $cache->set('key', 'value', -1);

        $this->assertFalse($cache->has('key'));
        $this->assertNull($cache->get('key'));
    }

    public function testIntTtlKeepsValueWhileValid()
    {
        $cache = new ArrayCache();
        $cache->set('key', 'value', 3600);

        $this->assertTrue($cache->has('key'));
        $this->assertSame('value', $cache->get('key'));
    }

    public function testDateIntervalTtlKeepsValueWhileValid()
    {
        $cache = new ArrayCache();
        $cache->set('key', 'value', new DateInterval('PT1H'));

        $this->assertTrue($cache->has('key'));
        $this->assertSame('value', $cache->get('key'));
    }

    public function testNullTtlNeverExpires()
    {
        $cache = new ArrayCache();
        $cache->set('key', 'value', null);

        $this->assertTrue($cache->has('key'));
    }
}
