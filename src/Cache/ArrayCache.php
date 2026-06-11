<?php

namespace ChicoRei\Packages\Correios\Cache;

use DateInterval;
use DateTimeImmutable;
use Psr\SimpleCache\CacheInterface;

/**
 * Minimal in-memory PSR-16 cache used as the default cache driver.
 */
class ArrayCache implements CacheInterface
{
    /**
     * @var array<string, array{value: mixed, expiresAt: int|null}>
     */
    private array $store = [];

    public function get(string $key, mixed $default = null): mixed
    {
        if (!$this->has($key)) {
            return $default;
        }

        return $this->store[$key]['value'];
    }

    public function set(string $key, mixed $value, null|int|DateInterval $ttl = null): bool
    {
        $this->store[$key] = [
            'value' => $value,
            'expiresAt' => $this->expirationFromTtl($ttl),
        ];

        return true;
    }

    public function delete(string $key): bool
    {
        unset($this->store[$key]);

        return true;
    }

    public function clear(): bool
    {
        $this->store = [];

        return true;
    }

    public function getMultiple(iterable $keys, mixed $default = null): iterable
    {
        $values = [];

        foreach ($keys as $key) {
            $values[$key] = $this->get($key, $default);
        }

        return $values;
    }

    public function setMultiple(iterable $values, null|int|DateInterval $ttl = null): bool
    {
        foreach ($values as $key => $value) {
            $this->set($key, $value, $ttl);
        }

        return true;
    }

    public function deleteMultiple(iterable $keys): bool
    {
        foreach ($keys as $key) {
            $this->delete($key);
        }

        return true;
    }

    public function has(string $key): bool
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

    private function expirationFromTtl(null|int|DateInterval $ttl): ?int
    {
        if ($ttl === null) {
            return null;
        }

        if ($ttl instanceof DateInterval) {
            return (new DateTimeImmutable())->add($ttl)->getTimestamp();
        }

        return time() + $ttl;
    }
}
