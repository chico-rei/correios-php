<?php

namespace ChicoRei\Packages\Correios\Request;

use ChicoRei\Packages\Correios\Model\Destinatario;
use ChicoRei\Packages\Correios\Model\PrePostagem;
use ChicoRei\Packages\Correios\Model\Remetente;

class CreatePrePostagemRequest extends PrePostagem implements CorreiosRequest
{
    /**
     * Dados do remetente.
     */
    public ?Remetente $remetente = null;

    /**
     * Dados do destinatário.
     */
    public ?Destinatario $destinatario = null;

    public function getRemetente(): ?Remetente
    {
        return $this->remetente;
    }

    /**
     * @param Remetente|array|null $remetente
     * @return $this
     */
    public function setRemetente($remetente): CreatePrePostagemRequest
    {
        $this->remetente = is_null($remetente) ? null : Remetente::create($remetente);
        return $this;
    }

    public function getDestinatario(): ?Destinatario
    {
        return $this->destinatario;
    }

    /**
     * @param Destinatario|array|null $destinatario
     * @return $this
     */
    public function setDestinatario($destinatario): CreatePrePostagemRequest
    {
        $this->destinatario = is_null($destinatario) ? null : Destinatario::create($destinatario);
        return $this;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getPath(): string
    {
        return '/prepostagem/v1/prepostagens';
    }

    public function getPayload(): array
    {
        return $this->toArray();
    }

    public function getQuery(): ?array
    {
        return null;
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'remetente' => $this->getRemetente() ? $this->getRemetente()->toArray() : null,
            'destinatario' => $this->getDestinatario() ? $this->getDestinatario()->toArray() : null,
        ]);
    }
}
