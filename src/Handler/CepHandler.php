<?php

namespace ChicoRei\Packages\Correios\Handler;

use ChicoRei\Packages\Correios\Client;
use ChicoRei\Packages\Correios\Exception\CorreiosAPIException;
use ChicoRei\Packages\Correios\Exception\CorreiosClientException;
use ChicoRei\Packages\Correios\Request\GetCepRequest;
use ChicoRei\Packages\Correios\Response\CepResponse;
use RuntimeException;

class CepHandler
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get Cep Info
     *
     * @param string|array|GetCepRequest $payload
     * @throws CorreiosAPIException
     * @throws CorreiosClientException
     */
    public function get($payload): CepResponse
    {
        if (is_string($payload)) {
            $payload = GetCepRequest::create(['cep' => $payload]);
        } elseif (is_array($payload)) {
            $payload = GetCepRequest::create($payload);
        }

        if (!$payload instanceof GetCepRequest) {
            throw new RuntimeException('Payload must be a string, an array or an instance of GetCepRequest');
        }

        $response = $this->client->sendRequest($payload);

        return CepResponse::create($response);
    }
}
