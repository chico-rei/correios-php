<?php

namespace ChicoRei\Packages\Correios\Model;

use ChicoRei\Packages\Correios\CorreiosObject;

class Endereco extends CorreiosObject
{
    /**
     * CEP. Informar um CEP válido com 8 caracteres numéricos.
     * Caso o endereço seja internacional, informar até 17 caracteres.
     */
    public ?string $cep = null;

    /**
     * Logradouro. Campo obrigatório. Tamanho máximo: 50 caracteres.
     */
    public ?string $logradouro = null;

    /**
     * Número do logradouro. Campo obrigatório. Tamanho máximo: 6 caracteres.
     */
    public ?string $numero = null;

    /**
     * Complemento do logradouro. Tamanho máximo: 30 caracteres.
     */
    public ?string $complemento = null;

    /**
     * Bairro. Campo obrigatório. Tamanho máximo: 30 caracteres.
     */
    public ?string $bairro = null;

    /**
     * Cidade. Campo obrigatório. Tamanho máximo: 30 caracteres.
     */
    public ?string $cidade = null;

    /**
     * UF do CEP. Campo obrigatório. Tamanho máximo: 2 caracteres.
     */
    public ?string $uf = null;

    /**
     * Região. Utilizado em prepostagens internacionais. Tamanho máximo: 50 caracteres.
     */
    public ?string $regiao = null;

    /**
     * DSigla do País. Utilizado em prepostagens internacionais. Tamanho máximo: 2 caracteres. Exemplo: BR, US, CA, FR
     */
    public ?string $pais = null;

    public function getCep(): ?string
    {
        return $this->cep;
    }

    public function setCep(?string $cep): Endereco
    {
        $this->cep = $cep;
        return $this;
    }

    public function getLogradouro(): ?string
    {
        return $this->logradouro;
    }

    public function setLogradouro(?string $logradouro): Endereco
    {
        $this->logradouro = $logradouro;
        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): Endereco
    {
        $this->numero = $numero;
        return $this;
    }

    public function getComplemento(): ?string
    {
        return $this->complemento;
    }

    public function setComplemento(?string $complemento): Endereco
    {
        $this->complemento = $complemento;
        return $this;
    }

    public function getBairro(): ?string
    {
        return $this->bairro;
    }

    public function setBairro(?string $bairro): Endereco
    {
        $this->bairro = $bairro;
        return $this;
    }

    public function getCidade(): ?string
    {
        return $this->cidade;
    }

    public function setCidade(?string $cidade): Endereco
    {
        $this->cidade = $cidade;
        return $this;
    }

    public function getUf(): ?string
    {
        return $this->uf;
    }

    public function setUf(?string $uf): Endereco
    {
        $this->uf = $uf;
        return $this;
    }

    public function getRegiao(): ?string
    {
        return $this->regiao;
    }

    public function setRegiao(?string $regiao): Endereco
    {
        $this->regiao = $regiao;
        return $this;
    }

    public function getPais(): ?string
    {
        return $this->pais;
    }

    public function setPais(?string $pais): Endereco
    {
        $this->pais = $pais;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'cep' => $this->getCep(),
            'logradouro' => $this->getLogradouro(),
            'numero' => $this->getNumero(),
            'complemento' => $this->getComplemento(),
            'bairro' => $this->getBairro(),
            'cidade' => $this->getCidade(),
            'uf' => $this->getUf(),
            'regiao' => $this->getRegiao(),
            'pais' => $this->getPais(),
        ];
    }
}
