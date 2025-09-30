<?php

namespace ChicoRei\Packages\Correios;

use Cache\Adapter\PHPArray\ArrayCachePool;
use ChicoRei\Packages\Correios\Handler\CepHandler;
use ChicoRei\Packages\Correios\Handler\PrePostagemHandler;
use Psr\SimpleCache\CacheInterface;

class Correios
{
    /**
     * Correios HTTP Client
     */
    private Client $client;

    private array $defaultOptions = [
        'timeout' => 60.0,
    ];

    private CepHandler $cepHandler;

    private PrePostagemHandler $prePostagemHandler;

    /**
     * Correios Service constructor.
     *
     * @param Account $authorization Correios Account object
     * @param CacheInterface|null $cacheDriver
     * @param array $guzzleOptions Guzzle options except http_errors and headers
     */
    public function __construct(
        Account        $authorization,
        CacheInterface $cacheDriver = null,
        array          $guzzleOptions = []
    ) {
        $guzzleOptions = array_merge($this->defaultOptions, $guzzleOptions);

        $this->client = new Client($authorization, $cacheDriver ?? new ArrayCachePool(), $guzzleOptions);
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function cepHandler(): CepHandler
    {
        if (!isset($this->cepHandler)) {
            $this->cepHandler = new CepHandler($this->client);
        }

        return $this->cepHandler;
    }

    public function prePostagemHandler(): PrePostagemHandler
    {
        if (!isset($this->prePostagemHandler)) {
            $this->prePostagemHandler = new PrePostagemHandler($this->client);
        }

        return $this->prePostagemHandler;
    }
}
