<?php

namespace ChicoRei\Packages\Correios\Request;

use ChicoRei\Packages\Correios\CorreiosObject;

class DeletePrePostagemByCodeRequest extends CorreiosObject implements CorreiosRequest
{
    /**
     * Código do Objeto.
     */
    public ?string $codigoObjeto = null;

    /**
     * Código do Objeto.
     */
    public ?string $idCorreiosSolicitanteCancelamento = null;

    public function getCodigoObjeto(): ?string
    {
        return $this->codigoObjeto;
    }

    public function setCodigoObjeto(?string $codigoObjeto): DeletePrePostagemByCodeRequest
    {
        $this->codigoObjeto = $codigoObjeto;
        return $this;
    }

    public function getIdCorreiosSolicitanteCancelamento(): ?string
    {
        return $this->idCorreiosSolicitanteCancelamento;
    }

    public function setIdCorreiosSolicitanteCancelamento(
        ?string $idCorreiosSolicitanteCancelamento
    ): DeletePrePostagemByCodeRequest {
        $this->idCorreiosSolicitanteCancelamento = $idCorreiosSolicitanteCancelamento;
        return $this;
    }

    public function getMethod(): string
    {
        return 'DELETE';
    }

    public function getPath(): string
    {
        return sprintf('/prepostagem/v1/prepostagens/objeto/%s', $this->getCodigoObjeto());
    }

    public function getPayload(): ?array
    {
        return null;
    }

    public function getQuery(): ?array
    {
        return [
            'idCorreiosSolicitanteCancelamento' => $this->getIdCorreiosSolicitanteCancelamento(),
        ];
    }

    public function toArray(): array
    {
        return [
            'codigoObjeto' => $this->getCodigoObjeto(),
            'idCorreiosSolicitanteCancelamento' => $this->getIdCorreiosSolicitanteCancelamento(),
        ];
    }
}
