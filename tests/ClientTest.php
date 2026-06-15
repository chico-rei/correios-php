<?php

namespace ChicoRei\Packages\Correios\Tests;

use ChicoRei\Packages\Correios\Account;
use ChicoRei\Packages\Correios\Cache\ArrayCache;
use ChicoRei\Packages\Correios\Exception\CorreiosAPIException;
use ChicoRei\Packages\Correios\Exception\CorreiosClientException;
use ChicoRei\Packages\Correios\Model\Token;
use ChicoRei\Packages\Correios\Request\GetCepRequest;
use ChicoRei\Packages\Correios\Request\CreatePrePostagemRequest;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    use MockClientTrait;

    public function testGetTokenReturnsTokenFromResponse()
    {
        $client = $this->makeMockClient([$this->tokenResponse('my-token')]);

        $token = $client->getToken();

        $this->assertInstanceOf(Token::class, $token);
        $this->assertSame('my-token', $token->getToken());
    }

    public function testGetTokenCachesTokenAcrossCalls()
    {
        $history = [];
        $client = $this->makeMockClient([$this->tokenResponse('cache-me')], $history);

        $first = $client->getToken();
        $second = $client->getToken();

        // Token endpoint should only be hit once; the second call is cached.
        $this->assertCount(1, $history);
        $this->assertSame($first->getToken(), $second->getToken());
    }

    public function testGetTokenUsesPostcardEndpoint()
    {
        $account = (new Account())
            ->setUsername('user')
            ->setPassword('secret')
            ->setPostcard('0067599079');

        $history = [];
        $client = $this->makeMockClient([$this->tokenResponse()], $history, $account);
        $client->getToken();

        $request = $history[0]['request'];
        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('/token/v1/autentica/cartaopostagem', $request->getUri()->getPath());
        $this->assertSame(['numero' => '0067599079'], json_decode((string) $request->getBody(), true));
    }

    public function testGetTokenUsesContractEndpoint()
    {
        $account = (new Account())
            ->setUsername('user')
            ->setPassword('secret')
            ->setContract('9912345678');

        $history = [];
        $client = $this->makeMockClient([$this->tokenResponse()], $history, $account);
        $client->getToken();

        $request = $history[0]['request'];
        $this->assertSame('/token/v1/autentica/contrato', $request->getUri()->getPath());
        $this->assertSame(['numero' => '9912345678'], json_decode((string) $request->getBody(), true));
    }

    public function testGetTokenUsesDefaultEndpointWithBasicAuth()
    {
        $history = [];
        $client = $this->makeMockClient([$this->tokenResponse()], $history);
        $client->getToken();

        $request = $history[0]['request'];
        $this->assertSame('/token/v1/autentica', $request->getUri()->getPath());
        $this->assertSame(
            'Basic ' . base64_encode('user:secret'),
            $request->getHeaderLine('Authorization')
        );
    }

    public function testGetTokenIncludesDrInPayload()
    {
        $account = (new Account())
            ->setUsername('user')
            ->setPassword('secret')
            ->setContract('9912345678')
            ->setDr(72);

        $history = [];
        $client = $this->makeMockClient([$this->tokenResponse()], $history, $account);
        $client->getToken();

        $body = json_decode((string) $history[0]['request']->getBody(), true);
        $this->assertSame(72, $body['dr']);
    }

    public function testSandboxAccountUsesSandboxBaseUri()
    {
        $account = $this->defaultAccount()->setSandbox(true);

        $history = [];
        $client = $this->makeMockClient([$this->tokenResponse()], $history, $account);
        $client->getToken();

        $this->assertSame('apihom.correios.com.br', $history[0]['request']->getUri()->getHost());
    }

    public function testSendRequestReturnsDecodedBodyAndSendsBearerToken()
    {
        $history = [];
        $client = $this->makeMockClient([
            $this->tokenResponse('bearer-xyz'),
            $this->jsonResponse(200, ['cep' => '01310100', 'uf' => 'SP']),
        ], $history);

        $result = $client->sendRequest(GetCepRequest::create(['cep' => '01310100']));

        $this->assertSame(['cep' => '01310100', 'uf' => 'SP'], $result);
        $this->assertCount(2, $history);
        $this->assertSame(
            'Bearer bearer-xyz',
            $history[1]['request']->getHeaderLine('Authorization')
        );
        $this->assertSame('/cep/v2/enderecos/01310100', $history[1]['request']->getUri()->getPath());
    }

    public function testSendRequestUsesCachedTokenWithoutTokenCall()
    {
        $account = $this->defaultAccount();
        $cache = new ArrayCache();
        $this->seedCachedToken($cache, $account);

        $history = [];
        $client = $this->makeMockClient([
            $this->jsonResponse(200, ['cep' => '01310100']),
        ], $history, $account, $cache);

        $client->sendRequest(GetCepRequest::create(['cep' => '01310100']));

        // Only the API request is performed; the token came from cache.
        $this->assertCount(1, $history);
        $this->assertSame('/cep/v2/enderecos/01310100', $history[0]['request']->getUri()->getPath());
    }

    public function testSendRequestStripsNullValuesFromPayload()
    {
        $account = $this->defaultAccount();
        $cache = new ArrayCache();
        $this->seedCachedToken($cache, $account);

        $history = [];
        $client = $this->makeMockClient([
            $this->jsonResponse(200, ['id' => '1']),
        ], $history, $account, $cache);

        $client->sendRequest(CreatePrePostagemRequest::create([
            'codigoServico' => '03220',
            'pesoInformado' => '300',
        ]));

        $body = json_decode((string) $history[0]['request']->getBody(), true);
        $this->assertSame('03220', $body['codigoServico']);
        $this->assertSame('300', $body['pesoInformado']);
        // Null fields are removed by Util::cleanArray before sending.
        $this->assertArrayNotHasKey('idCorreios', $body);
        $this->assertArrayNotHasKey('remetente', $body);
    }

    public function testSendRequestThrowsApiExceptionOnClientError()
    {
        $account = $this->defaultAccount();
        $cache = new ArrayCache();
        $this->seedCachedToken($cache, $account);

        $client = $this->makeMockClient([
            $this->jsonResponse(400, ['msgs' => ['CEP inválido']]),
        ], $history, $account, $cache);

        try {
            $client->sendRequest(GetCepRequest::create(['cep' => 'invalid']));
            $this->fail('Expected CorreiosAPIException was not thrown');
        } catch (CorreiosAPIException $exception) {
            $this->assertSame('CEP inválido', $exception->getMessage());
            $this->assertNotNull($exception->getRequest());
            $this->assertNotNull($exception->getResponse());
            $this->assertSame(400, $exception->getResponse()->getStatusCode());
        }
    }

    public function testSendRequestThrowsApiExceptionOnServerError()
    {
        $account = $this->defaultAccount();
        $cache = new ArrayCache();
        $this->seedCachedToken($cache, $account);

        $client = $this->makeMockClient([
            $this->jsonResponse(500, ['msgs' => ['Erro interno']]),
        ], $history, $account, $cache);

        $this->expectException(CorreiosAPIException::class);
        $this->expectExceptionMessage('Erro interno');

        $client->sendRequest(GetCepRequest::create(['cep' => '01310100']));
    }

    public function testSendRequestThrowsClientExceptionOnConnectionError()
    {
        $account = $this->defaultAccount();
        $cache = new ArrayCache();
        $this->seedCachedToken($cache, $account);

        $client = $this->makeMockClient([
            new ConnectException('Connection refused', new Request('GET', 'test')),
        ], $history, $account, $cache);

        $this->expectException(CorreiosClientException::class);

        $client->sendRequest(GetCepRequest::create(['cep' => '01310100']));
    }

    public function testGetLastResponseExposesRawResponse()
    {
        $account = $this->defaultAccount();
        $cache = new ArrayCache();
        $this->seedCachedToken($cache, $account);

        $client = $this->makeMockClient([
            $this->jsonResponse(200, ['cep' => '01310100']),
        ], $history, $account, $cache);

        $this->assertNull($client->getLastResponse());

        $client->sendRequest(GetCepRequest::create(['cep' => '01310100']));

        $this->assertNotNull($client->getLastResponse());
        $this->assertSame(200, $client->getLastResponse()->getStatusCode());
    }

    public function testGetAccountReturnsInjectedAccount()
    {
        $account = $this->defaultAccount();
        $client = $this->makeMockClient([$this->tokenResponse()], $history, $account);

        $this->assertSame($account, $client->getAccount());
    }
}
