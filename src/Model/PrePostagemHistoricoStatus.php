<?php

namespace ChicoRei\Packages\Correios\Model;

use Carbon\Carbon;
use ChicoRei\Packages\Correios\CorreiosObject;
use ChicoRei\Packages\Correios\Util;

class PrePostagemHistoricoStatus extends CorreiosObject
{
    /**
     * ID
     */
    public ?int $id = null;

    /**
     * Status da Pré-postagem: 1 - PREATENDIDO, 2 - PREPOSTADO, 3 - POSTADO , 4 - EXPIRADO, 5 - CANCELADO
     */
    public ?int $status = null;

    /**
     * Data Hora
     */
    public ?Carbon $dataHora = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): PrePostagemHistoricoStatus
    {
        $this->id = $id;
        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): PrePostagemHistoricoStatus
    {
        $this->status = $status;
        return $this;
    }

    public function getDataHora(): ?Carbon
    {
        return $this->dataHora;
    }

    /**
     * @param Carbon|string|null $dataHora
     * @return $this
     */
    public function setDataHora($dataHora): PrePostagemHistoricoStatus
    {
        $this->dataHora = Util::parseDate($dataHora);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'status' => $this->getStatus(),
            'dataHora' => $this->getDataHora() ? $this->getDataHora()->toIso8601String() : null,
        ];
    }
}
