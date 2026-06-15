<?php

namespace ChicoRei\Packages\Correios\Tests;

use ChicoRei\Packages\Correios\Account;
use ChicoRei\Packages\Correios\Cache\ArrayCache;
use ChicoRei\Packages\Correios\Client;
use ChicoRei\Packages\Correios\Correios;
use ChicoRei\Packages\Correios\Handler\CepHandler;
use ChicoRei\Packages\Correios\Handler\PrePostagemHandler;
use PHPUnit\Framework\TestCase;

class CorreiosTest extends TestCase
{
    private function makeCorreios(): Correios
    {
        return new Correios((new Account())->setUsername('user')->setPassword('secret'));
    }

    public function testGetClientReturnsClient()
    {
        $this->assertInstanceOf(Client::class, $this->makeCorreios()->getClient());
    }

    public function testCepHandlerReturnsHandlerAndIsMemoized()
    {
        $correios = $this->makeCorreios();

        $handler = $correios->cepHandler();

        $this->assertInstanceOf(CepHandler::class, $handler);
        $this->assertSame($handler, $correios->cepHandler());
    }

    public function testPrePostagemHandlerReturnsHandlerAndIsMemoized()
    {
        $correios = $this->makeCorreios();

        $handler = $correios->prePostagemHandler();

        $this->assertInstanceOf(PrePostagemHandler::class, $handler);
        $this->assertSame($handler, $correios->prePostagemHandler());
    }

    public function testAcceptsCustomCacheDriver()
    {
        $account = (new Account())->setUsername('user')->setPassword('secret');
        $correios = new Correios($account, new ArrayCache());

        $this->assertSame($account, $correios->getClient()->getAccount());
    }

    public function testMergesCustomGuzzleOptions()
    {
        $account = (new Account())->setUsername('user')->setPassword('secret');

        // Should construct without error when extra guzzle options are passed.
        $correios = new Correios($account, null, ['timeout' => 5.0]);

        $this->assertInstanceOf(Client::class, $correios->getClient());
    }
}
