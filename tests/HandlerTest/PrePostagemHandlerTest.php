<?php

namespace ChicoRei\Packages\Correios\Tests\HandlerTest;

use ChicoRei\Packages\Correios\Cache\ArrayCache;
use ChicoRei\Packages\Correios\Handler\PrePostagemHandler;
use ChicoRei\Packages\Correios\Request\CreatePrePostagemRequest;
use ChicoRei\Packages\Correios\Request\QueryPrePostagemRequest;
use ChicoRei\Packages\Correios\Response\CreatePrePostagemResponse;
use ChicoRei\Packages\Correios\Response\DeletePrePostagemByCodeResponse;
use ChicoRei\Packages\Correios\Response\GetPrePostagemPostadaResponse;
use ChicoRei\Packages\Correios\Response\QueryPrePostagemResponse;
use ChicoRei\Packages\Correios\Tests\MockClientTrait;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class PrePostagemHandlerTest extends TestCase
{
    use MockClientTrait;

    private function handlerReturning(array $body, ?array &$history = null): PrePostagemHandler
    {
        $account = $this->defaultAccount();
        $cache = new ArrayCache();
        $this->seedCachedToken($cache, $account);

        $client = $this->makeMockClient([
            $this->jsonResponse(200, $body),
        ], $history, $account, $cache);

        return new PrePostagemHandler($client);
    }

    public function testQueryWithStringBuildsRequest()
    {
        $history = [];
        $handler = $this->handlerReturning([
            'itens' => [
                ['id' => 'abc', 'codigoObjeto' => 'AA123456789BR', 'statusAtual' => 3],
            ],
            'page' => ['size' => 10, 'number' => 0],
        ], $history);

        $response = $handler->query('AA123456789BR');

        $this->assertInstanceOf(QueryPrePostagemResponse::class, $response);
        $this->assertCount(1, $response->getItens());
        $this->assertSame('abc', $response->getItens()[0]->getId());
        $this->assertSame(10, $response->getPage()->getSize());

        $request = $history[0]['request'];
        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('/prepostagem/v2/prepostagens', $request->getUri()->getPath());
        // codigoObjeto is sent as a query parameter, nulls stripped out.
        $this->assertStringContainsString('codigoObjeto=AA123456789BR', $request->getUri()->getQuery());
        $this->assertStringNotContainsString('idCorreios', $request->getUri()->getQuery());
    }

    public function testQueryWithArrayBuildsRequest()
    {
        $handler = $this->handlerReturning(['itens' => []]);

        $response = $handler->query(['status' => 'PREPOSTADO']);

        $this->assertInstanceOf(QueryPrePostagemResponse::class, $response);
    }

    public function testQueryRejectsInvalidPayload()
    {
        $handler = $this->handlerReturning(['itens' => []]);

        $this->expectException(RuntimeException::class);
        $handler->query(12345);
    }

    public function testCreateWithArrayReturnsResponse()
    {
        $history = [];
        $handler = $this->handlerReturning([
            'id' => 'pp-1',
            'codigoObjeto' => 'AA987654321BR',
            'statusAtual' => 2,
        ], $history);

        $response = $handler->create([
            'codigoServico' => '03220',
            'pesoInformado' => '300',
        ]);

        $this->assertInstanceOf(CreatePrePostagemResponse::class, $response);
        $this->assertSame('pp-1', $response->getId());
        $this->assertSame('POST', $history[0]['request']->getMethod());
        $this->assertSame('/prepostagem/v1/prepostagens', $history[0]['request']->getUri()->getPath());
    }

    public function testCreateWithRequestInstance()
    {
        $handler = $this->handlerReturning(['id' => 'pp-2']);

        $response = $handler->create(CreatePrePostagemRequest::create(['codigoServico' => '03220']));

        $this->assertInstanceOf(CreatePrePostagemResponse::class, $response);
        $this->assertSame('pp-2', $response->getId());
    }

    public function testCreateRejectsInvalidPayload()
    {
        $handler = $this->handlerReturning(['id' => 'pp-1']);

        $this->expectException(RuntimeException::class);
        $handler->create('not-an-array');
    }

    public function testDeleteByCodeReturnsResponse()
    {
        $history = [];
        $handler = $this->handlerReturning([
            'resultadoCancelamento' => 'OK',
            'mensagem' => 'Cancelado com sucesso',
        ], $history);

        $response = $handler->deleteByCode('AA123456789BR');

        $this->assertInstanceOf(DeletePrePostagemByCodeResponse::class, $response);
        $this->assertSame('OK', $response->getResultadoCancelamento());
        $this->assertSame('DELETE', $history[0]['request']->getMethod());
    }

    public function testDeleteByCodeWithArray()
    {
        $history = [];
        $handler = $this->handlerReturning([
            'resultadoCancelamento' => 'OK',
        ], $history);

        $response = $handler->deleteByCode(['codigoObjeto' => 'AA123456789BR']);

        $this->assertInstanceOf(DeletePrePostagemByCodeResponse::class, $response);
        $this->assertStringContainsString(
            '/prepostagem/v1/prepostagens/objeto/AA123456789BR',
            $history[0]['request']->getUri()->getPath()
        );
    }

    public function testDeleteByCodeRejectsInvalidPayload()
    {
        $handler = $this->handlerReturning(['resultadoCancelamento' => 'OK']);

        $this->expectException(RuntimeException::class);
        $handler->deleteByCode(12345);
    }

    public function testGetPostedReturnsResponse()
    {
        $history = [];
        $handler = $this->handlerReturning([
            'id' => 'posted-1',
            'codigoObjeto' => 'AA123456789BR',
            'codigoServico' => '03220',
        ], $history);

        $response = $handler->getPosted('AA123456789BR');

        $this->assertInstanceOf(GetPrePostagemPostadaResponse::class, $response);
        $this->assertSame('posted-1', $response->getId());
        $this->assertSame('GET', $history[0]['request']->getMethod());
    }

    public function testGetPostedWithArray()
    {
        $history = [];
        $handler = $this->handlerReturning(['id' => 'posted-1'], $history);

        $response = $handler->getPosted(['codigoObjeto' => 'AA123456789BR']);

        $this->assertInstanceOf(GetPrePostagemPostadaResponse::class, $response);
        $this->assertSame('/prepostagem/v1/prepostagens/postada', $history[0]['request']->getUri()->getPath());
        $this->assertStringContainsString(
            'codigoObjeto=AA123456789BR',
            $history[0]['request']->getUri()->getQuery()
        );
    }

    public function testGetPostedRejectsInvalidPayload()
    {
        $handler = $this->handlerReturning(['id' => 'posted-1']);

        $this->expectException(RuntimeException::class);
        $handler->getPosted(12345);
    }
}
