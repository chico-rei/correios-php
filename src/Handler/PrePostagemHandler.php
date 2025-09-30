<?php

namespace ChicoRei\Packages\Correios\Handler;

use ChicoRei\Packages\Correios\Client;
use ChicoRei\Packages\Correios\Exception\CorreiosAPIException;
use ChicoRei\Packages\Correios\Exception\CorreiosClientException;
use ChicoRei\Packages\Correios\Request\CreatePrePostagemRequest;
use ChicoRei\Packages\Correios\Response\CreatePrePostagemResponse;
use RuntimeException;

class PrePostagemHandler
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
     * Create Pré Postagem
     *
     * @param string|array|CreatePrePostagemRequest $payload
     * @throws CorreiosAPIException
     * @throws CorreiosClientException
     */
    public function create($payload): CreatePrePostagemResponse
    {
        if (is_array($payload)) {
            $payload = CreatePrePostagemRequest::create($payload);
        }

        if (!$payload instanceof CreatePrePostagemRequest) {
            throw new RuntimeException('Payload must be a string, an array or an instance of CreatePrePostagemRequest');
        }

        $response = $this->client->sendRequest($payload);

        return CreatePrePostagemResponse::create($response);
    }
}
