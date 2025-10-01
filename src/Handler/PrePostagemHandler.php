<?php

namespace ChicoRei\Packages\Correios\Handler;

use ChicoRei\Packages\Correios\Client;
use ChicoRei\Packages\Correios\Exception\CorreiosAPIException;
use ChicoRei\Packages\Correios\Exception\CorreiosClientException;
use ChicoRei\Packages\Correios\Request\CreatePrePostagemRequest;
use ChicoRei\Packages\Correios\Request\DeletePrePostagemByCodeRequest;
use ChicoRei\Packages\Correios\Request\QueryPrePostagemRequest;
use ChicoRei\Packages\Correios\Response\CreatePrePostagemResponse;
use ChicoRei\Packages\Correios\Response\DeletePrePostagemByCodeResponse;
use ChicoRei\Packages\Correios\Response\QueryPrePostagemResponse;
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
     * Busca Pré Postagem
     *
     * @param string|array|QueryPrePostagemRequest $payload
     * @throws CorreiosAPIException
     * @throws CorreiosClientException
     */
    public function query($payload): QueryPrePostagemResponse
    {
        if (is_string($payload)) {
            $payload = QueryPrePostagemRequest::create(['codigoObjeto' => $payload]);
        } elseif (is_array($payload)) {
            $payload = QueryPrePostagemRequest::create($payload);
        }

        if (!$payload instanceof QueryPrePostagemRequest) {
            throw new RuntimeException(
                'Payload must be a string, an array or an instance of QueryPrePostagemRequest'
            );
        }

        $response = $this->client->sendRequest($payload);

        return QueryPrePostagemResponse::create($response);
    }

    /**
     * Cria Pré Postagem
     *
     * @param array|CreatePrePostagemRequest $payload
     * @throws CorreiosAPIException
     * @throws CorreiosClientException
     */
    public function create($payload): CreatePrePostagemResponse
    {
        if (is_array($payload)) {
            $payload = CreatePrePostagemRequest::create($payload);
        }

        if (!$payload instanceof CreatePrePostagemRequest) {
            throw new RuntimeException('Payload must be an array or an instance of CreatePrePostagemRequest');
        }

        $response = $this->client->sendRequest($payload);

        return CreatePrePostagemResponse::create($response);
    }

    /**
     * Cancela Pré Postagem pelo Código do Objeto
     *
     * @param string|array|DeletePrePostagemByCodeRequest $payload
     * @throws CorreiosAPIException
     * @throws CorreiosClientException
     */
    public function deleteByCode($payload): DeletePrePostagemByCodeResponse
    {
        if (is_string($payload)) {
            $payload = DeletePrePostagemByCodeRequest::create(['codigoObjeto' => $payload]);
        } elseif (is_array($payload)) {
            $payload = DeletePrePostagemByCodeRequest::create($payload);
        }

        if (!$payload instanceof DeletePrePostagemByCodeRequest) {
            throw new RuntimeException(
                'Payload must be a string, an array or an instance of DeletePrePostagemByCodeRequest'
            );
        }

        $response = $this->client->sendRequest($payload);

        return DeletePrePostagemByCodeResponse::create($response);
    }
}
