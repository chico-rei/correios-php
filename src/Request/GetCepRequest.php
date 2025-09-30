<?php

namespace ChicoRei\Packages\Correios\Request;

use ChicoRei\Packages\Correios\CorreiosObject;

class GetCepRequest extends CorreiosObject implements CorreiosRequest
{
    /**
     * CEP
     */
    public ?string $cep = null;

    public function getCep(): ?string
    {
        return $this->cep;
    }

    public function setCep(?string $cep): GetCepRequest
    {
        $this->cep = $cep;
        return $this;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return 'GET';
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return sprintf('/cep/v2/enderecos/%s', $this->getCep());
    }

    /**
     * @return array|null
     */
    public function getPayload(): ?array
    {
        return null;
    }

    /**
     * @return array|null
     */
    public function getQuery(): ?array
    {
        return null;
    }

    /**
     * Returns array representation of object
     *
     * @return array
     */
    public function toArray(): array
    {
        return ['cep' => $this->getCep()];
    }
}
