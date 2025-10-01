<?php

namespace ChicoRei\Packages\Correios\Response;

use ChicoRei\Packages\Correios\CorreiosObject;
use ChicoRei\Packages\Correios\Request\CorreiosRequest;

class DeletePrePostagemByCodeResponse extends CorreiosObject
{
    /**
     * Resultado do Cancelamento.
     */
    public ?string $resultadoCancelamento = null;

    /**
     * Mensagem.
     */
    public ?string $mensagem = null;

    /**
     * Id Recibo.
     */
    public ?string $idRecibo = null;

    public function getResultadoCancelamento(): ?string
    {
        return $this->resultadoCancelamento;
    }

    public function setResultadoCancelamento(?string $resultadoCancelamento): DeletePrePostagemByCodeResponse
    {
        $this->resultadoCancelamento = $resultadoCancelamento;
        return $this;
    }

    public function getMensagem(): ?string
    {
        return $this->mensagem;
    }

    public function setMensagem(?string $mensagem): DeletePrePostagemByCodeResponse
    {
        $this->mensagem = $mensagem;
        return $this;
    }

    public function getIdRecibo(): ?string
    {
        return $this->idRecibo;
    }

    public function setIdRecibo(?string $idRecibo): DeletePrePostagemByCodeResponse
    {
        $this->idRecibo = $idRecibo;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'resultadoCancelamento' => $this->getResultadoCancelamento(),
            'mensagem' => $this->getMensagem(),
            'idRecibo' => $this->getIdRecibo(),
        ];
    }
}
