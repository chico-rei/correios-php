<?php

namespace ChicoRei\Packages\Correios\Response;

use Carbon\Carbon;
use ChicoRei\Packages\Correios\CorreiosObject;
use ChicoRei\Packages\Correios\Model\ServicoAdicional;
use ChicoRei\Packages\Correios\Util;

class GetPrePostagemPostadaResponse extends CorreiosObject
{
    /**
     * ID.
     */
    public ?string $id = null;

    /**
     * Número externo Cliente.
     */
    public ?string $numeroExternoCliente = null;

    /**
     * Numero Cartão Postagem.
     */
    public ?string $numeroCartaoPostagem = null;

    /**
     * CEP Agencia.
     */
    public ?string $cepAgencia = null;

    /**
     * CEP Destino.
     */
    public ?string $cepDestino = null;

    /**
     * Número Atendimento.
     */
    public ?string $numeroAtendimento = null;

    /**
     * Data da Postagem.
     */
    public ?Carbon $dataPostagem = null;

    /**
     * Valor do Atendimento.
     */
    public ?float $valorAtendimento = null;

    /**
     * Número Sistema.
     */
    public ?string $numeroSistema = null;

    /**
     * CEP Remetente.
     */
    public ?string $cepRemetente = null;

    /**
     * CEP Destinatário.
     */
    public ?string $cepDestinatario = null;

    /**
     * Código identificador do objeto. Tamanho máximo: 13 caracteres.
     */
    public ?string $codigoObjeto = null;

    /**
     * Código identificador do objeto. Tamanho máximo: 13 caracteres.
     */
    public ?string $codigoServico = null;

    /**
     * Nome do Serviço.
     */
    public ?string $nomeServico = null;

    /**
     * Altura do Objeto.
     */
    public ?string $alturaObjeto = null;

    /**
     * Comprimento do Objeto.
     */
    public ?string $comprimentoObjeto = null;

    /**
     * Largura do Objeto.
     */
    public ?string $larguraObjeto = null;

    /**
     * Diametro do Objeto.
     */
    public ?string $diametroObjeto = null;

    /**
     * Peso do Objeto.
     */
    public ?string $pesoObjeto = null;

    /**
     * Peso Tarifado do Objeto.
     */
    public ?string $pesoTarifadoObjeto = null;

    /**
     * Valor Declarado do Objeto.
     */
    public ?string $valorDeclaradoObjeto = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): GetPrePostagemPostadaResponse
    {
        $this->id = $id;
        return $this;
    }

    public function getNumeroExternoCliente(): ?string
    {
        return $this->numeroExternoCliente;
    }

    public function setNumeroExternoCliente(?string $numeroExternoCliente): GetPrePostagemPostadaResponse
    {
        $this->numeroExternoCliente = $numeroExternoCliente;
        return $this;
    }

    public function getNumeroCartaoPostagem(): ?string
    {
        return $this->numeroCartaoPostagem;
    }

    public function setNumeroCartaoPostagem(?string $numeroCartaoPostagem): GetPrePostagemPostadaResponse
    {
        $this->numeroCartaoPostagem = $numeroCartaoPostagem;
        return $this;
    }

    public function getCepAgencia(): ?string
    {
        return $this->cepAgencia;
    }

    public function setCepAgencia(?string $cepAgencia): GetPrePostagemPostadaResponse
    {
        $this->cepAgencia = $cepAgencia;
        return $this;
    }

    public function getCepDestino(): ?string
    {
        return $this->cepDestino;
    }

    public function setCepDestino(?string $cepDestino): GetPrePostagemPostadaResponse
    {
        $this->cepDestino = $cepDestino;
        return $this;
    }

    public function getNumeroAtendimento(): ?string
    {
        return $this->numeroAtendimento;
    }

    public function setNumeroAtendimento(?string $numeroAtendimento): GetPrePostagemPostadaResponse
    {
        $this->numeroAtendimento = $numeroAtendimento;
        return $this;
    }

    public function getDataPostagem(): ?Carbon
    {
        return $this->dataPostagem;
    }

    public function setDataPostagem($dataPostagem): GetPrePostagemPostadaResponse
    {
        $this->dataPostagem = Util::parseDate($dataPostagem);
        return $this;
    }

    public function getValorAtendimento(): ?float
    {
        return $this->valorAtendimento;
    }

    public function setValorAtendimento(?float $valorAtendimento): GetPrePostagemPostadaResponse
    {
        $this->valorAtendimento = $valorAtendimento;
        return $this;
    }

    public function getNumeroSistema(): ?string
    {
        return $this->numeroSistema;
    }

    public function setNumeroSistema(?string $numeroSistema): GetPrePostagemPostadaResponse
    {
        $this->numeroSistema = $numeroSistema;
        return $this;
    }

    public function getCepRemetente(): ?string
    {
        return $this->cepRemetente;
    }

    public function setCepRemetente(?string $cepRemetente): GetPrePostagemPostadaResponse
    {
        $this->cepRemetente = $cepRemetente;
        return $this;
    }

    public function getCepDestinatario(): ?string
    {
        return $this->cepDestinatario;
    }

    public function setCepDestinatario(?string $cepDestinatario): GetPrePostagemPostadaResponse
    {
        $this->cepDestinatario = $cepDestinatario;
        return $this;
    }

    public function getCodigoObjeto(): ?string
    {
        return $this->codigoObjeto;
    }

    public function setCodigoObjeto(?string $codigoObjeto): GetPrePostagemPostadaResponse
    {
        $this->codigoObjeto = $codigoObjeto;
        return $this;
    }

    public function getCodigoServico(): ?string
    {
        return $this->codigoServico;
    }

    public function setCodigoServico(?string $codigoServico): GetPrePostagemPostadaResponse
    {
        $this->codigoServico = $codigoServico;
        return $this;
    }

    public function getNomeServico(): ?string
    {
        return $this->nomeServico;
    }

    public function setNomeServico(?string $nomeServico): GetPrePostagemPostadaResponse
    {
        $this->nomeServico = $nomeServico;
        return $this;
    }

    public function getAlturaObjeto(): ?string
    {
        return $this->alturaObjeto;
    }

    public function setAlturaObjeto(?string $alturaObjeto): GetPrePostagemPostadaResponse
    {
        $this->alturaObjeto = $alturaObjeto;
        return $this;
    }

    public function getComprimentoObjeto(): ?string
    {
        return $this->comprimentoObjeto;
    }

    public function setComprimentoObjeto(?string $comprimentoObjeto): GetPrePostagemPostadaResponse
    {
        $this->comprimentoObjeto = $comprimentoObjeto;
        return $this;
    }

    public function getLarguraObjeto(): ?string
    {
        return $this->larguraObjeto;
    }

    public function setLarguraObjeto(?string $larguraObjeto): GetPrePostagemPostadaResponse
    {
        $this->larguraObjeto = $larguraObjeto;
        return $this;
    }

    public function getDiametroObjeto(): ?string
    {
        return $this->diametroObjeto;
    }

    public function setDiametroObjeto(?string $diametroObjeto): GetPrePostagemPostadaResponse
    {
        $this->diametroObjeto = $diametroObjeto;
        return $this;
    }

    public function getPesoObjeto(): ?string
    {
        return $this->pesoObjeto;
    }

    public function setPesoObjeto(?string $pesoObjeto): GetPrePostagemPostadaResponse
    {
        $this->pesoObjeto = $pesoObjeto;
        return $this;
    }

    public function getPesoTarifadoObjeto(): ?string
    {
        return $this->pesoTarifadoObjeto;
    }

    public function setPesoTarifadoObjeto(?string $pesoTarifadoObjeto): GetPrePostagemPostadaResponse
    {
        $this->pesoTarifadoObjeto = $pesoTarifadoObjeto;
        return $this;
    }

    public function getValorDeclaradoObjeto(): ?string
    {
        return $this->valorDeclaradoObjeto;
    }

    public function setValorDeclaradoObjeto(?string $valorDeclaradoObjeto): GetPrePostagemPostadaResponse
    {
        $this->valorDeclaradoObjeto = $valorDeclaradoObjeto;
        return $this;
    }

    /**
     * Serviços Adicionais.
     *
     * @var ServicoAdicional[]|null
     */
    public ?array $listaServicoAdicional = null;

    public function getListaServicoAdicional(): ?array
    {
        return $this->listaServicoAdicional;
    }

    /**
     * @param ServicoAdicional[]|array|null $listaServicoAdicional
     * @return $this
     */
    public function setListaServicoAdicional(?array $listaServicoAdicional): GetPrePostagemPostadaResponse
    {
        if (is_array($listaServicoAdicional)) {
            $this->listaServicoAdicional = [];

            foreach ($listaServicoAdicional as $servicoAdicional) {
                $this->addServicoAdicional($servicoAdicional);
            }
        } else {
            $this->listaServicoAdicional = null;
        }

        return $this;
    }

    /**
     * @param ServicoAdicional|array $servicoAdicional
     */
    public function addServicoAdicional($servicoAdicional): GetPrePostagemPostadaResponse
    {
        if (! is_array($servicoAdicional) && ! $servicoAdicional instanceof ServicoAdicional) {
            throw new \InvalidArgumentException('The argument must be an instance of ServicoAdicional or an array');
        }

        if (!isset($this->listaServicoAdicional)) {
            $this->listaServicoAdicional = [];
        }

        $this->listaServicoAdicional[] = ServicoAdicional::create($servicoAdicional);

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'numeroExternoCliente' => $this->getNumeroExternoCliente(),
            'numeroCartaoPostagem' => $this->getNumeroCartaoPostagem(),
            'cepAgencia' => $this->getCepAgencia(),
            'cepDestino' => $this->getCepDestino(),
            'numeroAtendimento' => $this->getNumeroAtendimento(),
            'dataPostagem' => $this->getDataPostagem() ? $this->getDataPostagem()->toIso8601String() : null,
            'valorAtendimento' => $this->getValorAtendimento(),
            'numeroSistema' => $this->getNumeroSistema(),
            'cepRemetente' => $this->getCepRemetente(),
            'cepDestinatario' => $this->getCepDestinatario(),
            'codigoObjeto' => $this->getCodigoObjeto(),
            'codigoServico' => $this->getCodigoServico(),
            'nomeServico' => $this->getNomeServico(),
            'alturaObjeto' => $this->getAlturaObjeto(),
            'comprimentoObjeto' => $this->getComprimentoObjeto(),
            'larguraObjeto' => $this->getLarguraObjeto(),
            'diametroObjeto' => $this->getDiametroObjeto(),
            'pesoObjeto' => $this->getPesoObjeto(),
            'pesoTarifadoObjeto' => $this->getPesoTarifadoObjeto(),
            'valorDeclaradoObjeto' => $this->getValorDeclaradoObjeto(),
            'listaServicoAdicional' => $this->getListaServicoAdicional()
                ? array_map(function (ServicoAdicional $servicoAdicional) {
                    return $servicoAdicional->toArray();
                }, $this->getListaServicoAdicional())
                : null,
        ];
    }
}
