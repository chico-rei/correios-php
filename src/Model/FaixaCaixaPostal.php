<?php

namespace ChicoRei\Packages\Correios\Model;

use ChicoRei\Packages\Correios\CorreiosObject;

class FaixaCaixaPostal extends CorreiosObject
{
    /**
     * Número inicial
     */
    public ?int $nuInicial = null;

    /**
     * Número final
     */
    public ?int $nuFinal = null;

    public function getNuInicial(): ?int
    {
        return $this->nuInicial;
    }

    public function setNuInicial(?int $nuInicial): FaixaCaixaPostal
    {
        $this->nuInicial = $nuInicial;
        return $this;
    }

    public function getNuFinal(): ?int
    {
        return $this->nuFinal;
    }

    public function setNuFinal(?int $nuFinal): FaixaCaixaPostal
    {
        $this->nuFinal = $nuFinal;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'nuInicial' => $this->getNuInicial(),
            'nuFinal' => $this->getNuFinal(),
        ];
    }
}
