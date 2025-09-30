<?php

namespace ChicoRei\Packages\Correios\Model;

use ChicoRei\Packages\Correios\CorreiosObject;
use InvalidArgumentException;

class ServicoAdicional extends CorreiosObject
{
    /**
     * Código do serviço adicional. Não pode ser deixado em branco. Informar com 3 caracteres.
     */
    public ?string $codigoServicoAdicional = null;

    /**
     * Tipo de serviço adicional. O preenchimento deste campo é automático.
     * Não é necessário o envio desta informação no momento da pré-postagem.
     */
    public ?string $tipoServicoAdicional = null;

    /**
     * Nome do serviço adicional. O preenchimento deste campo é automático.
     * Não é necessário o envio desta informação no momento da pré-postagem.
     */
    public ?string $nomeServicoAdicional = null;

    /**
     * Valor do serviço adicional. O preenchimento deste campo é automático.
     * Não é necessário o envio desta informação no momento da pré-postagem.
     */
    public ?string $valorServicoAdicional = null;

    /**
     * Valor declarado do objeto a ser pré-postado.
     * Não pode ser deixado em branco caso o serviço adicional seja do tipo valor declarado.
     */
    public ?string $valorDeclarado = null;

    /**
     * Sigla do serviço adicional. O preenchimento deste campo é automático.
     * Não é necessário o envio desta informação no momento da pré-postagem.
     */
    public ?string $siglaServicoAdicional = null;

    /**
     * Orientação para entrega no vizinho.
     * Obrigatório se o serviço adicional (011) for selecionado.
     */
    public ?string $orientacaoEntregaVizinho = null;

    /**
     * Indica o tipo de checklist que deverá ser preenchido no momento da postagem.
     * Aceita apenas 01-Celular, 04-Eletrônico, 05-Documento ou 07-Conteúdo.
     */
    public ?string $tipoChecklist = null;

    /**
     * Lista de códigos dos subitens para o tipoChecklist: 05-documentos.
     * Podem ser listados até 8 códigos de documentos.
     *
     * @var SubitemCheckList[]|null
     */
    public ?array $subitensCheckList = null;

    public function getCodigoServicoAdicional(): ?string
    {
        return $this->codigoServicoAdicional;
    }

    public function setCodigoServicoAdicional(?string $codigoServicoAdicional): ServicoAdicional
    {
        $this->codigoServicoAdicional = $codigoServicoAdicional;
        return $this;
    }

    public function getTipoServicoAdicional(): ?string
    {
        return $this->tipoServicoAdicional;
    }

    public function setTipoServicoAdicional(?string $tipoServicoAdicional): ServicoAdicional
    {
        $this->tipoServicoAdicional = $tipoServicoAdicional;
        return $this;
    }

    public function getNomeServicoAdicional(): ?string
    {
        return $this->nomeServicoAdicional;
    }

    public function setNomeServicoAdicional(?string $nomeServicoAdicional): ServicoAdicional
    {
        $this->nomeServicoAdicional = $nomeServicoAdicional;
        return $this;
    }

    public function getValorServicoAdicional(): ?string
    {
        return $this->valorServicoAdicional;
    }

    public function setValorServicoAdicional(?string $valorServicoAdicional): ServicoAdicional
    {
        $this->valorServicoAdicional = $valorServicoAdicional;
        return $this;
    }

    public function getValorDeclarado(): ?string
    {
        return $this->valorDeclarado;
    }

    public function setValorDeclarado(?string $valorDeclarado): ServicoAdicional
    {
        $this->valorDeclarado = $valorDeclarado;
        return $this;
    }

    public function getSiglaServicoAdicional(): ?string
    {
        return $this->siglaServicoAdicional;
    }

    public function setSiglaServicoAdicional(?string $siglaServicoAdicional): ServicoAdicional
    {
        $this->siglaServicoAdicional = $siglaServicoAdicional;
        return $this;
    }

    public function getOrientacaoEntregaVizinho(): ?string
    {
        return $this->orientacaoEntregaVizinho;
    }

    public function setOrientacaoEntregaVizinho(?string $orientacaoEntregaVizinho): ServicoAdicional
    {
        $this->orientacaoEntregaVizinho = $orientacaoEntregaVizinho;
        return $this;
    }

    public function getTipoChecklist(): ?string
    {
        return $this->tipoChecklist;
    }

    public function setTipoChecklist(?string $tipoChecklist): ServicoAdicional
    {
        $this->tipoChecklist = $tipoChecklist;
        return $this;
    }

    /**
     * @return SubitemCheckList[]|null
     */
    public function getSubitensCheckList(): ?array
    {
        return $this->subitensCheckList;
    }

    /**
     * @param SubitemCheckList[]|null $subitensCheckList
     * @return ServicoAdicional
     */
    public function setSubitensCheckList(?array $subitensCheckList): ServicoAdicional
    {
        if (is_array($subitensCheckList)) {
            $this->subitensCheckList = [];

            foreach ($subitensCheckList as $subitemCheckList) {
                $this->addSubitemCheckList($subitemCheckList);
            }
        } else {
            $this->subitensCheckList = null;
        }

        return $this;
    }

    /**
     * @param SubitemCheckList|array $subitemCheckList
     * @return ServicoAdicional
     */
    public function addSubitemCheckList($subitemCheckList): ServicoAdicional
    {
        if (! is_array($subitemCheckList) && ! $subitemCheckList instanceof SubitemCheckList) {
            throw new InvalidArgumentException('The argument must be an instance of SubitemCheckList or an array');
        }

        if (!isset($this->subitensCheckList)) {
            $this->subitensCheckList = [];
        }

        $this->subitensCheckList[] = SubitemCheckList::create($subitemCheckList);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'codigoServicoAdicional' => $this->getCodigoServicoAdicional(),
            'tipoServicoAdicional' => $this->getTipoServicoAdicional(),
            'nomeServicoAdicional' => $this->getNomeServicoAdicional(),
            'valorServicoAdicional' => $this->getValorServicoAdicional(),
            'valorDeclarado' => $this->getValorDeclarado(),
            'siglaServicoAdicional' => $this->getSiglaServicoAdicional(),
            'orientacaoEntregaVizinho' => $this->getOrientacaoEntregaVizinho(),
            'tipoChecklist' => $this->getTipoChecklist(),
            'subitensCheckList' => $this->getSubitensCheckList()
                ? array_map(function (SubitemCheckList $subitemCheckList) {
                    return $subitemCheckList->toArray();
                }, $this->getSubitensCheckList())
                : null,
        ];
    }
}
