<?php

namespace ChicoRei\Packages\Correios\Model;

use ChicoRei\Packages\Correios\CorreiosObject;

class SubitemCheckList extends CorreiosObject
{
    /**
     * Subitem para o tipoChecklist: 05-documentos
     */
    public ?string $codigo = null;

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(?string $codigo): SubitemCheckList
    {
        $this->codigo = $codigo;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'codigo' => $this->getCodigo(),
        ];
    }
}
