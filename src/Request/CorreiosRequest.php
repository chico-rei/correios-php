<?php

namespace ChicoRei\Packages\Correios\Request;

interface CorreiosRequest
{
    /**
     * @return string
     */
    public function getMethod(): string;

    /**
     * @return string
     */
    public function getPath(): string;

    /**
     * @return array|null
     */
    public function getPayload(): ?array;

    /**
     * @return array|null
     */
    public function getQuery(): ?array;
}
