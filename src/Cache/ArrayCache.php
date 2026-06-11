<?php

namespace ChicoRei\Packages\Correios\Cache;

use DateInterval;
use DateTimeImmutable;
use Psr\SimpleCache\CacheInterface;

/**
 * Minimal in-memory PSR-16 cache used as the default cache driver.
 *
 * Signatures are intentionally untyped to stay compatible with
 * psr/simple-cache ^1.0 on PHP 7.4.
 */
class ArrayCache implements CacheInterface
{
    /**
     * @var array<string, array{value: mixed, expiresAt: int|null}>
     */
    private array $store = [];

    public function get($key, $default = null)
    {
        if (!$this->has($key)) {
            return $default;
        }

        return $this->store[$key]['value'];
    }

    public function set($key, $value, $ttl = null)
    {
        $this->store[$key] = [
            'value' => $value,
            'expiresAt' => $this->expirationFromTtl($ttl),
        ];

        return true;
    }

    public function delete($key)
    {
        unset($this->store[$key]);

        return true;
    }

    public function clear()
    {
        $this->store = [];

        return true;
    }

    public function getMultiple($keys, $default = null)
    {
        $values = [];

        foreach ($keys as $key) {
            $values[$key] = $this->get($key, $default);
        }

        return $values;
    }

    public function setMultiple($values, $ttl = null)
    {
        foreach ($values as $key => $value) {
            $this->set($key, $value, $ttl);
        }

        return true;
    }

    public function deleteMultiple($keys)
    {
        foreach ($keys as $key) {
            $this->delete($key);
        }

        return true;
    }

    public function has($key)
    {
        if (!array_key_exists($key, $this->store)) {
            return false;
        }

        $expiresAt = $this->store[$key]['expiresAt'];

        if ($expiresAt !== null && $expiresAt <= time()) {
            unset($this->store[$key]);

            return false;
        }

        return true;
    }

    /**
     * @param int|DateInterval|null $ttl
     */
    private function expirationFromTtl($ttl): ?int
    {
        if ($ttl === null) {
            return null;
        }

        if ($ttl instanceof DateInterval) {
            return (new DateTimeImmutable())->add($ttl)->getTimestamp();
        }

        return time() + (int) $ttl;
    }
}
