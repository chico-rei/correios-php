<?php

namespace ChicoRei\Packages\Correios;

use ChicoRei\Packages\Correios\Exception\CorreiosAPIException;
use ChicoRei\Packages\Correios\Exception\CorreiosClientException;
use ChicoRei\Packages\Correios\Model\Token;
use ChicoRei\Packages\Correios\Request\CorreiosRequest;
use GuzzleHttp\Client as Guzzle;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use Psr\Http\Message\ResponseInterface;
use Psr\SimpleCache\CacheInterface;
use Psr\SimpleCache\InvalidArgumentException;

class Client
{
    /**
     * Correios Web Service API Url
     */
    const API_URL = 'https://api.correios.com.br';

    /**
     * Correios Web Service Sandbox API Url
     */
    const API_SANDBOX_URL = 'https://apihom.correios.com.br';

    private Account $authorization;

    private CacheInterface $cacheDriver;

    private Guzzle $guzzle;

    private ?ResponseInterface $lastResponse;

    private ?string $tokenCacheKey = null;

    /**
     * @param Account $authorization
     * @param array $guzzleOptions
     * @param CacheInterface $cacheDriver
     */
    public function __construct(Account $authorization, CacheInterface $cacheDriver, array $guzzleOptions)
    {
        $this->authorization = $authorization;
        $this->cacheDriver = $cacheDriver;
        $this->tokenCacheKey = 'cr_correios_tk_'.implode('_', [
                $this->authorization->getUsername() ?? '',
                $this->authorization->getContract() ?? '',
                $this->authorization->getPostcard() ?? '',
            ]);

        $this->guzzle = new Guzzle(array_merge($guzzleOptions, [
            'base_uri' => $this->authorization->isSandbox() ? self::API_SANDBOX_URL : self::API_URL,
            'http_errors' => true,
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]));
    }

    /**
     * @param CorreiosRequest $request
     * @return array
     * @throws CorreiosClientException
     * @throws CorreiosAPIException
     */
    public function sendRequest(CorreiosRequest $request)
    {
        try {
            $payload = $request->getPayload();
            $query = $request->getQuery();

            $this->lastResponse = $this->guzzle->request(
                $request->getMethod(),
                $request->getPath(),
                [
                    'query' => Util::cleanArray($query),
                    'headers' => [
                        'Authorization' => 'Bearer '. $this->getToken()->getToken()
                    ],
                    'json' => Util::cleanArray($payload)
                ]
            );

            return $this->handleResponse($this->lastResponse);
        } catch (ServerException | ClientException $exception) {
            $this->lastResponse = $exception->getResponse();
            $response = $this->handleResponse($this->lastResponse);

            throw new CorreiosAPIException(
                $response['msgs'][0] ?? $exception->getMessage(),
                $exception->getCode(),
                $exception->getRequest(),
                $exception->getResponse()
            );
        } catch (GuzzleException | RequestException | InvalidArgumentException $exception) {
            throw new CorreiosClientException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    /**
     * Decode the Response
     *
     * @param ResponseInterface $response
     * @return array|null
     */
    public function handleResponse(ResponseInterface $response): ?array
    {
        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * Get the last response from API
     */
    public function getLastResponse(): ?ResponseInterface
    {
        return $this->lastResponse;
    }

    /**
     * Get the token
     *
     * @throws InvalidArgumentException
     * @throws GuzzleException
     */
    public function getToken(): Token
    {
        if ($this->cacheDriver->has($this->tokenCacheKey)) {
            return $this->cacheDriver->get($this->tokenCacheKey);
        }

        if ($this->authorization->getPostcard()) {
            $tokenUrl = '/token/v1/autentica/cartaopostagem';
            $payload = ['numero' => $this->authorization->getPostcard()];
        } elseif ($this->authorization->getContract()) {
            $tokenUrl = '/token/v1/autentica/contrato';
            $payload = ['numero' => $this->authorization->getContract()];
        } else {
            $tokenUrl = '/token/v1/autentica';
            $payload = [];
        }

        if ($this->authorization->getDr()) {
            $payload['dr'] = $this->authorization->getDr();
        }

        $response = $this->guzzle->request(
            'POST',
            $tokenUrl,
            [
                'headers' => [
                    'Authorization' => 'Basic '.base64_encode(
                        $this->authorization->getUsername().':'.$this->authorization->getPassword()
                    ),
                ],
                'json' => $payload
            ]
        );

        $token = Token::create($this->handleResponse($response));

        $this->cacheDriver->set(
            $this->tokenCacheKey,
            $token,
            $token->getExpiraEm()->clone()->subMinutes(10)->timestamp
        );

        return $token;
    }
}
