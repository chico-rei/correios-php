<?php

namespace ChicoRei\Packages\Correios\Model;

use ChicoRei\Packages\Correios\CorreiosObject;

class MalotePrePostagem extends CorreiosObject
{
    /**
     * Número do malote
     */
    public ?string $numeroMalote = null;

    // TODO Demais propriedades

    public function getNumeroMalote(): ?string
    {
        return $this->numeroMalote;
    }

    public function setNumeroMalote(?string $numeroMalote): MalotePrePostagem
    {
        $this->numeroMalote = $numeroMalote;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'numeroMalote' => $this->getNumeroMalote(),
        ];
    }
}
