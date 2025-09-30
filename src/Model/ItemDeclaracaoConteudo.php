<?php

namespace ChicoRei\Packages\Correios\Model;

use ChicoRei\Packages\Correios\CorreiosObject;

class ItemDeclaracaoConteudo extends CorreiosObject
{
    /**
     * Descrição do conteúdo do que será despachado na pré-postagem.
     * Caso não seja informado o número da nota fiscal, esse campo é obrigatório.
     * Tamanho máximo: 60 caracteres.
     */
    public ?string $conteudo = null;

    /**
     * Quantidade de itens que estão sendo despachado na pré-postagem.
     * Caso não seja informado o número da nota fiscal, esse campo é obrigatório.
     * Tamanho máximo: 11 dígitos.
     */
    public ?string $quantidade = null;

    /**
     * Valor total dos objetos que estão sendo despachados na pré-postagem.
     * Caso não seja informado o número da nota fiscal, esse campo é obrigatório.
     * Tamanho máximo: 19 dígitos e 2 casas decimais.
     */
    public ?string $valor = null;

    public function getConteudo(): ?string
    {
        return $this->conteudo;
    }

    public function setConteudo(?string $conteudo): ItemDeclaracaoConteudo
    {
        $this->conteudo = $conteudo;
        return $this;
    }

    public function getQuantidade(): ?string
    {
        return $this->quantidade;
    }

    public function setQuantidade(?string $quantidade): ItemDeclaracaoConteudo
    {
        $this->quantidade = $quantidade;
        return $this;
    }

    public function getValor(): ?string
    {
        return $this->valor;
    }

    public function setValor(?string $valor): ItemDeclaracaoConteudo
    {
        $this->valor = $valor;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'conteudo' => $this->getConteudo(),
            'quantidade' => $this->getQuantidade(),
            'valor' => $this->getValor(),
        ];
    }
}
