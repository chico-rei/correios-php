<?php

namespace ChicoRei\Packages\Correios\Request;

use ChicoRei\Packages\Correios\Model\PrePostagem;

class CreatePrePostagemRequest extends PrePostagem implements CorreiosRequest
{
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
}
