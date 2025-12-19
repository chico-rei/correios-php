<?php

namespace ChicoRei\Packages\Correios\Request;

use ChicoRei\Packages\Correios\CorreiosObject;

class GetPrePostagemPostadaRequest extends CorreiosObject implements CorreiosRequest
{
    /**
     * Código identificador do objeto. Tamanho máximo: 13 caracteres.
     */
    public ?string $codigoObjeto = null;

    public function getCodigoObjeto(): ?string
    {
        return $this->codigoObjeto;
    }

    public function setCodigoObjeto(?string $codigoObjeto): GetPrePostagemPostadaRequest
    {
        $this->codigoObjeto = $codigoObjeto;
        return $this;
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getPath(): string
    {
        return '/prepostagem/v1/prepostagens/postada';
    }

    public function getPayload(): ?array
    {
        return null;
    }

    public function getQuery(): ?array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return [
            'codigoObjeto' => $this->getCodigoObjeto(),
        ];
    }
}
