<?php

namespace ChicoRei\Packages\Correios\Model;

use Carbon\Carbon;
use ChicoRei\Packages\Correios\CorreiosObject;
use ChicoRei\Packages\Correios\Util;

class Token extends CorreiosObject
{
    // TODO Missing properties: certificado, contrato, cartaoPostagem, api, apiGrupos, apis, tipoUnidade
    /**
     * Ambiente
     */
    public ?string $ambiente = null;

    /**
     * Identificador do usuário
     */
    public ?string $id = null;

    /**
     * IP do requisitante
     */
    public ?string $ip = null;

    /**
     * Perfil: PF: Pessoa Física, PJ: Pessoa Jurídica
     */
    public ?string $perfil = null;

    /**
     * CNPJ do usuário
     */
    public ?string $cnpj = null;

    /**
     * Código internacional do usuário
     */
    public ?int $pjInternacional = null;

    /**
     * CPF do usuário
     */
    public ?string $cpf = null;

    /**
     * Categoria
     */
    public ?string $categoria = null;

    /**
     * Número da chave de acesso
     */
    public ?int $chv = null;

    /**
     * CIE do usuário
     */
    public ?string $cie = null;

    /**
     * Data e hora de emissão do token
     */
    public ?Carbon $emissao = null;

    /**
     * Data e hora de expiração do token
     */
    public ?Carbon $expiraEm = null;

    /**
     * Deslocamento do GMT/UTC
     */
    public ?string $zoneOffset = null;

    /**
     * Paths
     */
    public ?array $paths = null;

    /**
     * Token que deve usado na requisição
     */
    public ?string $token = null;

    public function getAmbiente(): ?string
    {
        return $this->ambiente;
    }

    public function setAmbiente(?string $ambiente): Token
    {
        $this->ambiente = $ambiente;
        return $this;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): Token
    {
        $this->id = $id;
        return $this;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(?string $ip): Token
    {
        $this->ip = $ip;
        return $this;
    }

    public function getPerfil(): ?string
    {
        return $this->perfil;
    }

    public function setPerfil(?string $perfil): Token
    {
        $this->perfil = $perfil;
        return $this;
    }

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function setCnpj(?string $cnpj): Token
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    public function getPjInternacional(): ?int
    {
        return $this->pjInternacional;
    }

    public function setPjInternacional(?int $pjInternacional): Token
    {
        $this->pjInternacional = $pjInternacional;
        return $this;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(?string $cpf): Token
    {
        $this->cpf = $cpf;
        return $this;
    }

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(?string $categoria): Token
    {
        $this->categoria = $categoria;
        return $this;
    }

    public function getChv(): ?int
    {
        return $this->chv;
    }

    public function setChv(?int $chv): Token
    {
        $this->chv = $chv;
        return $this;
    }

    public function getCie(): ?string
    {
        return $this->cie;
    }

    public function setCie(?string $cie): Token
    {
        $this->cie = $cie;
        return $this;
    }

    public function getEmissao(): ?Carbon
    {
        return $this->emissao;
    }

    /**
     * @param Carbon|string|null $emissao
     * @return $this
     */
    public function setEmissao($emissao): Token
    {
        $this->emissao = Util::parseDate($emissao);
        return $this;
    }

    public function getExpiraEm(): ?Carbon
    {
        return $this->expiraEm;
    }

    /**
     * @param Carbon|string|null $expiraEm
     * @return $this
     */
    public function setExpiraEm($expiraEm): Token
    {
        $this->expiraEm = Util::parseDate($expiraEm);
        return $this;
    }

    public function getZoneOffset(): ?string
    {
        return $this->zoneOffset;
    }

    public function setZoneOffset(?string $zoneOffset): Token
    {
        $this->zoneOffset = $zoneOffset;
        return $this;
    }

    public function getPaths(): ?array
    {
        return $this->paths;
    }

    public function setPaths(?array $paths): Token
    {
        $this->paths = $paths;
        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(?string $token): Token
    {
        $this->token = $token;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'ambiente' => $this->getAmbiente(),
            'id' => $this->getId(),
            'ip' => $this->getIp(),
            'perfil' => $this->getPerfil(),
            'cnpj' => $this->getCnpj(),
            'pjInternacional' => $this->getPjInternacional(),
            'cpf' => $this->getCpf(),
            'categoria' => $this->getCategoria(),
            'chv' => $this->getChv(),
            'cie' => $this->getCie(),
            'emissao' => $this->getEmissao() ? $this->getEmissao()->toIso8601String() : null,
            'expiraEm' => $this->getExpiraEm() ? $this->getExpiraEm()->toIso8601String() : null,
            'zoneOffset' => $this->getZoneOffset(),
            'paths' => $this->getPaths(),
            'token' => $this->getToken(),
        ];
    }
}
