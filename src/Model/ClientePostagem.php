<?php

namespace ChicoRei\Packages\Correios\Model;

use ChicoRei\Packages\Correios\CorreiosObject;

class ClientePostagem extends CorreiosObject
{
    /**
     * Nome. Deve ser composto de nome e sobrenome.
     * Não pode ser deixado em branco, mínimo de 3 caracteres e máximo 50 caracteres.
     */
    public ?string $nome = null;

    /**
     * Código.
     */
    public ?string $codigo = null;

    /**
     * Indicador de malote. Para malotes será sempre S.
     */
    public ?string $indicadorMalote = null;

    /**
     * DDD do telefone. Se informado, deve ter 2 caracteres numéricos.
     */
    public ?string $dddTelefone = null;

    /**
     * DDI do telefone. Se informado, deve ter 3 caracteres numéricos.
     * Utilizado em prepostagens internacionais.
     */
    public ?string $ddiTelefone = null;

    /**
     * Número do telefone. Se informado, deve ter 8 caracteres numéricos.
     */
    public ?string $telefone = null;

    /**
     * DDD do celular. Obrigatório se a entrega for em locker.
     * Se informado, deve ter 2 caracteres numéricos.
     */
    public ?string $dddCelular = null;

    /**
     * DDI do celular. Se informado, deve ter 3 caracteres numéricos.
     * Utilizado em prepostagens internacionais.
     */
    public ?string $ddiCelular = null;

    /**
     * Número do celular. Obrigatório se a entrega for em locker.
     * Se informado, deve ter 9 caracteres numéricos.
     */
    public ?string $celular = null;

    /**
     * E-mail. Se informado, deve ter no máximo 255 caracteres e seguir o formato padrão "login@domínio".
     */
    public ?string $email = null;

    /**
     * CPF ou CNPJ. Obrigatório se a entrega for em locker. Se informado, deve ser válido.
     */
    public ?string $cpfCnpj = null;

    /**
     * Passaporte ou RNM da prepostagem. Tamanho máximo: 30 caracteres.
     */
    public ?string $documentoEstrangeiro = null;

    /**
     * Observação preenchida a critério do cliente. Tamanho máximo: 100 caracteres.
     */
    public ?string $obs = null;

    /**
     * Endereço.
     */
    public ?Endereco $endereco = null;

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): ClientePostagem
    {
        $this->nome = $nome;
        return $this;
    }

    public function getCodigo(): ?string
    {
        return $this->codigo;
    }

    public function setCodigo(?string $codigo): ClientePostagem
    {
        $this->codigo = $codigo;
        return $this;
    }

    public function getIndicadorMalote(): ?string
    {
        return $this->indicadorMalote;
    }

    public function setIndicadorMalote(?string $indicadorMalote): ClientePostagem
    {
        $this->indicadorMalote = $indicadorMalote;
        return $this;
    }

    public function getDddTelefone(): ?string
    {
        return $this->dddTelefone;
    }

    public function setDddTelefone(?string $dddTelefone): ClientePostagem
    {
        $this->dddTelefone = $dddTelefone;
        return $this;
    }

    public function getDdiTelefone(): ?string
    {
        return $this->ddiTelefone;
    }

    public function setDdiTelefone(?string $ddiTelefone): ClientePostagem
    {
        $this->ddiTelefone = $ddiTelefone;
        return $this;
    }

    public function getTelefone(): ?string
    {
        return $this->telefone;
    }

    public function setTelefone(?string $telefone): ClientePostagem
    {
        $this->telefone = $telefone;
        return $this;
    }

    public function getDddCelular(): ?string
    {
        return $this->dddCelular;
    }

    public function setDddCelular(?string $dddCelular): ClientePostagem
    {
        $this->dddCelular = $dddCelular;
        return $this;
    }

    public function getDdiCelular(): ?string
    {
        return $this->ddiCelular;
    }

    public function setDdiCelular(?string $ddiCelular): ClientePostagem
    {
        $this->ddiCelular = $ddiCelular;
        return $this;
    }

    public function getCelular(): ?string
    {
        return $this->celular;
    }

    public function setCelular(?string $celular): ClientePostagem
    {
        $this->celular = $celular;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): ClientePostagem
    {
        $this->email = $email;
        return $this;
    }

    public function getCpfCnpj(): ?string
    {
        return $this->cpfCnpj;
    }

    public function setCpfCnpj(?string $cpfCnpj): ClientePostagem
    {
        $this->cpfCnpj = $cpfCnpj;
        return $this;
    }

    public function getDocumentoEstrangeiro(): ?string
    {
        return $this->documentoEstrangeiro;
    }

    public function setDocumentoEstrangeiro(?string $documentoEstrangeiro): ClientePostagem
    {
        $this->documentoEstrangeiro = $documentoEstrangeiro;
        return $this;
    }

    public function getObs(): ?string
    {
        return $this->obs;
    }

    public function setObs(?string $obs): ClientePostagem
    {
        $this->obs = $obs;
        return $this;
    }

    public function getEndereco(): ?Endereco
    {
        return $this->endereco;
    }

    /**
     * @param Endereco|array|null $endereco
     * @return $this
     */
    public function setEndereco($endereco): ClientePostagem
    {
        $this->endereco = is_null($endereco) ? null : Endereco::create($endereco);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'nome' => $this->getNome(),
            'codigo' => $this->getCodigo(),
            'indicadorMalote' => $this->getIndicadorMalote(),
            'dddTelefone' => $this->getDddTelefone(),
            'ddiTelefone' => $this->getDdiTelefone(),
            'telefone' => $this->getTelefone(),
            'dddCelular' => $this->getDddCelular(),
            'ddiCelular' => $this->getDdiCelular(),
            'celular' => $this->getCelular(),
            'email' => $this->getEmail(),
            'cpfCnpj' => $this->getCpfCnpj(),
            'documentoEstrangeiro' => $this->getDocumentoEstrangeiro(),
            'obs' => $this->getObs(),
            'endereco' => $this->getEndereco() ? $this->getEndereco()->toArray() : null,
        ];
    }
}
