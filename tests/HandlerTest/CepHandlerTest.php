<?php

namespace ChicoRei\Packages\Correios\Tests\HandlerTest;

use ChicoRei\Packages\Correios\Account;
use ChicoRei\Packages\Correios\Cache\ArrayCache;
use ChicoRei\Packages\Correios\Handler\CepHandler;
use ChicoRei\Packages\Correios\Request\GetCepRequest;
use ChicoRei\Packages\Correios\Response\CepResponse;
use ChicoRei\Packages\Correios\Tests\MockClientTrait;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class CepHandlerTest extends TestCase
{
    use MockClientTrait;

    private function handlerReturning(array $body, ?array &$history = null): CepHandler
    {
        $account = $this->defaultAccount();
        $cache = new ArrayCache();
        $this->seedCachedToken($cache, $account);

        $client = $this->makeMockClient([
            $this->jsonResponse(200, $body),
        ], $history, $account, $cache);

        return new CepHandler($client);
    }

    public function testGetWithStringBuildsRequestAndReturnsResponse()
    {
        $history = [];
        $handler = $this->handlerReturning([
            'cep' => '01310100',
            'uf' => 'SP',
            'localidade' => 'São Paulo',
        ], $history);

        $response = $handler->get('01310100');

        $this->assertInstanceOf(CepResponse::class, $response);
        $this->assertSame('01310100', $response->getCep());
        $this->assertSame('SP', $response->getUf());
        $this->assertSame('/cep/v2/enderecos/01310100', $history[0]['request']->getUri()->getPath());
    }

    public function testGetWithArrayBuildsRequest()
    {
        $handler = $this->handlerReturning(['cep' => '01310100']);

        $response = $handler->get(['cep' => '01310100']);

        $this->assertInstanceOf(CepResponse::class, $response);
        $this->assertSame('01310100', $response->getCep());
    }

    public function testGetWithRequestInstance()
    {
        $handler = $this->handlerReturning(['cep' => '01310100']);

        $response = $handler->get(GetCepRequest::create(['cep' => '01310100']));

        $this->assertInstanceOf(CepResponse::class, $response);
    }

    public function testGetParsesNestedCaixasPostais()
    {
        $handler = $this->handlerReturning([
            'cep' => '70002900',
            'caixasPostais' => [
                ['nuInicial' => 1, 'nuFinal' => 50],
                ['nuInicial' => 51, 'nuFinal' => 100],
            ],
        ]);

        $response = $handler->get('70002900');

        $this->assertCount(2, $response->getCaixasPostais());
        $this->assertSame(1, $response->getCaixasPostais()[0]->getNuInicial());
    }

    public function testGetRejectsInvalidPayload()
    {
        $handler = $this->handlerReturning(['cep' => '01310100']);

        $this->expectException(RuntimeException::class);
        $handler->get(12345);
    }
}
