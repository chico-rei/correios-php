<?php

namespace ChicoRei\Packages\Correios\Response;

use Carbon\Carbon;
use ChicoRei\Packages\Correios\Model\MalotePrePostagem;
use ChicoRei\Packages\Correios\Model\PrePostagem;
use ChicoRei\Packages\Correios\Model\PrePostagemHistoricoStatus;
use InvalidArgumentException;

class CreatePrePostagemResponse extends PrePostagem
{
    /**
     * ID.
     */
    public ?string $id = null;

    /**
     * ETicket.
     */
    public ?string $eticket = null;

    /**
     * Data ETicket.
     */
    public ?Carbon $dataEticket = null;

    /**
     * Embalagem.
     */
    public ?string $embalagem = null;

    /**
     * Descrição do código do serviço.
     */
    public ?string $servico = null;

    /**
     * Status da Pré-postagem: 1 - PREATENDIDO, 2 - PREPOSTADO, 3 - POSTADO, 4 - EXPRIRADO, 5 - CANCELADO ,
     * 6 - ESTORNADO.
     */
    public ?int $statusAtual = null;

    /**
     * Data em que foi configurada o status atual
     */
    public ?Carbon $dataHoraStatusAtual = null;

    /**
     * Descrição do status atual
     */
    public ?string $descStatusAtual = null;

    /**
     * Data Hora
     */
    public ?Carbon $dataHora = null;

    /**
     * Tipo Rotulo
     */
    public ?string $tipoRotulo = null;

    /**
     * Tipo Rotulo
     */
    public ?string $retornoIntegracao = null;

    /**
     * Sistema Origem
     */
    public ?string $sistemaOrigem = null;

    /**
     * Valor Total Bens
     */
    public ?float $valorTotalBens = null;

    /**
     * Lista Id Prepostagem Objetos
     */
    public ?array $listaIdPrepostagemObjetos = null;

    /**
     * Quantidade
     */
    public ?int $quantidade = null;

    /**
     * IdRecibo da solicitação da geração da pré-postagem asincrona
     */
    public ?string $reciboSolicitacaoAssincrona = null;

    /**
     * IdRecibo da solicitação da geração do rótulo assincrono
     */
    public ?string $reciboSolicitacaoAssincronaRotulo = null;

    /**
     * Formato do objeto na pré-aferição
     */
    public ?string $codigoFormatoObjetoPreAfericao = null;

    /**
     * Altura na pré-aferição
     */
    public ?string $alturaPreAfericao = null;

    /**
     * Largurana pré-aferição
     */
    public ?string $larguraPreAfericao = null;

    /**
     * Comprimento na pré-aferição
     */
    public ?string $comprimentoPreAfericao = null;

    /**
     * Diametro na pré-aferição
     */
    public ?string $diametroPreAfericao = null;

    /**
     * Peso na pré-aferição
     */
    public ?string $pesoPreAfericao = null;

    /**
     * Data e hora da pré aferição
     */
    public ?Carbon $dataHoraPreAfericao = null;

    /**
     * Mcu da unidade de pre-aferição
     */
    public ?string $mcuUnidadePreAfericao = null;

    /**
     * Identificador da balança de cubagem de pre-aferição
     */
    public ?string $idBalancaCubagem = null;

    /**
     * Cep destino na pre-aferição
     */
    public ?string $cepDestinoPreAfericao = null;

    /**
     * Objeto identificado como objeto perigoso (Dangerous Goods Regulations - DGR), valores possíveis: S=Sim, N=não.
     */
    public ?string $ehObjetoDgr = null;

    /**
     * Tipo Objeto.
     */
    public ?string $tipoObjeto = null;

    /**
     * Erro Assincrono.
     */
    public ?string $erroAssincrono = null;

    /**
     * Código de estampa 2D.
     */
    public ?string $codigoEstampa2D = null;

    /**
     * Histórico Status.
     *
     * @var PrePostagemHistoricoStatus[]|null
     */
    public ?array $historicoStatus = null;

    /**
     * Indicador Malote.
     */
    public ?string $indicadorMalote = null;

    /**
     * Código da gráfica
     */
    public ?int $codigoGrafica = null;

    /**
     * Código do remetente
     */
    public ?string $codigoRemetente = null;

    /**
     * Código do destnatário
     */
    public ?string $codigoDestinatario = null;

    /**
     * Malote PrePostagem
     */
    public ?MalotePrePostagem $malotePrePostagem = null;

    /**
     * Lista Malotes
     *
     * @var MalotePrePostagem[]|null
     */
    public ?array $listaMalotes = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): CreatePrePostagemResponse
    {
        $this->id = $id;
        return $this;
    }

    public function getEticket(): ?string
    {
        return $this->eticket;
    }

    public function setEticket(?string $eticket): CreatePrePostagemResponse
    {
        $this->eticket = $eticket;
        return $this;
    }

    public function getDataEticket(): ?Carbon
    {
        return $this->dataEticket;
    }

    /**
     * @param Carbon|string|null $dataEticket
     * @return $this
     */
    public function setDataEticket($dataEticket): CreatePrePostagemResponse
    {
        $this->dataEticket = is_null($dataEticket) ? null : Carbon::parse($dataEticket);
        return $this;
    }

    public function getEmbalagem(): ?string
    {
        return $this->embalagem;
    }

    public function setEmbalagem(?string $embalagem): CreatePrePostagemResponse
    {
        $this->embalagem = $embalagem;
        return $this;
    }

    public function getServico(): ?string
    {
        return $this->servico;
    }

    public function setServico(?string $servico): CreatePrePostagemResponse
    {
        $this->servico = $servico;
        return $this;
    }

    public function getStatusAtual(): ?int
    {
        return $this->statusAtual;
    }

    public function setStatusAtual(?int $statusAtual): CreatePrePostagemResponse
    {
        $this->statusAtual = $statusAtual;
        return $this;
    }

    public function getDataHoraStatusAtual(): ?Carbon
    {
        return $this->dataHoraStatusAtual;
    }

    /**
     * @param Carbon|string|null $dataHoraStatusAtual
     * @return $this
     */
    public function setDataHoraStatusAtual($dataHoraStatusAtual): CreatePrePostagemResponse
    {
        $this->dataHoraStatusAtual = is_null($dataHoraStatusAtual) ? null : Carbon::parse($dataHoraStatusAtual);
        return $this;
    }

    public function getDescStatusAtual(): ?string
    {
        return $this->descStatusAtual;
    }

    public function setDescStatusAtual(?string $descStatusAtual): CreatePrePostagemResponse
    {
        $this->descStatusAtual = $descStatusAtual;
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
    public function setDataHora($dataHora): CreatePrePostagemResponse
    {
        $this->dataHora = is_null($dataHora) ? null : Carbon::parse($dataHora);
        return $this;
    }

    public function getTipoRotulo(): ?string
    {
        return $this->tipoRotulo;
    }

    public function setTipoRotulo(?string $tipoRotulo): CreatePrePostagemResponse
    {
        $this->tipoRotulo = $tipoRotulo;
        return $this;
    }

    public function getRetornoIntegracao(): ?string
    {
        return $this->retornoIntegracao;
    }

    public function setRetornoIntegracao(?string $retornoIntegracao): CreatePrePostagemResponse
    {
        $this->retornoIntegracao = $retornoIntegracao;
        return $this;
    }

    public function getSistemaOrigem(): ?string
    {
        return $this->sistemaOrigem;
    }

    public function setSistemaOrigem(?string $sistemaOrigem): CreatePrePostagemResponse
    {
        $this->sistemaOrigem = $sistemaOrigem;
        return $this;
    }

    public function getValorTotalBens(): ?float
    {
        return $this->valorTotalBens;
    }

    public function setValorTotalBens(?float $valorTotalBens): CreatePrePostagemResponse
    {
        $this->valorTotalBens = $valorTotalBens;
        return $this;
    }

    public function getListaIdPrepostagemObjetos(): ?array
    {
        return $this->listaIdPrepostagemObjetos;
    }

    public function setListaIdPrepostagemObjetos(?array $listaIdPrepostagemObjetos): CreatePrePostagemResponse
    {
        $this->listaIdPrepostagemObjetos = $listaIdPrepostagemObjetos;
        return $this;
    }

    public function getQuantidade(): ?int
    {
        return $this->quantidade;
    }

    public function setQuantidade(?int $quantidade): CreatePrePostagemResponse
    {
        $this->quantidade = $quantidade;
        return $this;
    }

    public function getReciboSolicitacaoAssincrona(): ?string
    {
        return $this->reciboSolicitacaoAssincrona;
    }

    public function setReciboSolicitacaoAssincrona(?string $reciboSolicitacaoAssincrona): CreatePrePostagemResponse
    {
        $this->reciboSolicitacaoAssincrona = $reciboSolicitacaoAssincrona;
        return $this;
    }

    public function getReciboSolicitacaoAssincronaRotulo(): ?string
    {
        return $this->reciboSolicitacaoAssincronaRotulo;
    }

    public function setReciboSolicitacaoAssincronaRotulo(
        ?string $reciboSolicitacaoAssincronaRotulo
    ): CreatePrePostagemResponse {
        $this->reciboSolicitacaoAssincronaRotulo = $reciboSolicitacaoAssincronaRotulo;
        return $this;
    }

    public function getCodigoFormatoObjetoPreAfericao(): ?string
    {
        return $this->codigoFormatoObjetoPreAfericao;
    }

    public function setCodigoFormatoObjetoPreAfericao(
        ?string $codigoFormatoObjetoPreAfericao
    ): CreatePrePostagemResponse {
        $this->codigoFormatoObjetoPreAfericao = $codigoFormatoObjetoPreAfericao;
        return $this;
    }

    public function getAlturaPreAfericao(): ?string
    {
        return $this->alturaPreAfericao;
    }

    public function setAlturaPreAfericao(?string $alturaPreAfericao): CreatePrePostagemResponse
    {
        $this->alturaPreAfericao = $alturaPreAfericao;
        return $this;
    }

    public function getLarguraPreAfericao(): ?string
    {
        return $this->larguraPreAfericao;
    }

    public function setLarguraPreAfericao(?string $larguraPreAfericao): CreatePrePostagemResponse
    {
        $this->larguraPreAfericao = $larguraPreAfericao;
        return $this;
    }

    public function getComprimentoPreAfericao(): ?string
    {
        return $this->comprimentoPreAfericao;
    }

    public function setComprimentoPreAfericao(?string $comprimentoPreAfericao): CreatePrePostagemResponse
    {
        $this->comprimentoPreAfericao = $comprimentoPreAfericao;
        return $this;
    }

    public function getDiametroPreAfericao(): ?string
    {
        return $this->diametroPreAfericao;
    }

    public function setDiametroPreAfericao(?string $diametroPreAfericao): CreatePrePostagemResponse
    {
        $this->diametroPreAfericao = $diametroPreAfericao;
        return $this;
    }

    public function getPesoPreAfericao(): ?string
    {
        return $this->pesoPreAfericao;
    }

    public function setPesoPreAfericao(?string $pesoPreAfericao): CreatePrePostagemResponse
    {
        $this->pesoPreAfericao = $pesoPreAfericao;
        return $this;
    }

    public function getDataHoraPreAfericao(): ?Carbon
    {
        return $this->dataHoraPreAfericao;
    }

    /**
     * @param Carbon|string|null $dataHoraPreAfericao
     * @return $this
     */
    public function setDataHoraPreAfericao($dataHoraPreAfericao): CreatePrePostagemResponse
    {
        $this->dataHoraPreAfericao = is_null($dataHoraPreAfericao) ? null : Carbon::parse($dataHoraPreAfericao);
        return $this;
    }

    public function getMcuUnidadePreAfericao(): ?string
    {
        return $this->mcuUnidadePreAfericao;
    }

    public function setMcuUnidadePreAfericao(?string $mcuUnidadePreAfericao): CreatePrePostagemResponse
    {
        $this->mcuUnidadePreAfericao = $mcuUnidadePreAfericao;
        return $this;
    }

    public function getIdBalancaCubagem(): ?string
    {
        return $this->idBalancaCubagem;
    }

    public function setIdBalancaCubagem(?string $idBalancaCubagem): CreatePrePostagemResponse
    {
        $this->idBalancaCubagem = $idBalancaCubagem;
        return $this;
    }

    public function getCepDestinoPreAfericao(): ?string
    {
        return $this->cepDestinoPreAfericao;
    }

    public function setCepDestinoPreAfericao(?string $cepDestinoPreAfericao): CreatePrePostagemResponse
    {
        $this->cepDestinoPreAfericao = $cepDestinoPreAfericao;
        return $this;
    }

    public function getEhObjetoDgr(): ?string
    {
        return $this->ehObjetoDgr;
    }

    public function setEhObjetoDgr(?string $ehObjetoDgr): CreatePrePostagemResponse
    {
        $this->ehObjetoDgr = $ehObjetoDgr;
        return $this;
    }

    public function getTipoObjeto(): ?string
    {
        return $this->tipoObjeto;
    }

    public function setTipoObjeto(?string $tipoObjeto): CreatePrePostagemResponse
    {
        $this->tipoObjeto = $tipoObjeto;
        return $this;
    }

    public function getErroAssincrono(): ?string
    {
        return $this->erroAssincrono;
    }

    public function setErroAssincrono(?string $erroAssincrono): CreatePrePostagemResponse
    {
        $this->erroAssincrono = $erroAssincrono;
        return $this;
    }

    public function getCodigoEstampa2D(): ?string
    {
        return $this->codigoEstampa2D;
    }

    public function setCodigoEstampa2D(?string $codigoEstampa2D): CreatePrePostagemResponse
    {
        $this->codigoEstampa2D = $codigoEstampa2D;
        return $this;
    }

    /**
     * @return PrePostagemHistoricoStatus[]|null
     */
    public function getHistoricoStatus(): ?array
    {
        return $this->historicoStatus;
    }

    /**
     * @param PrePostagemHistoricoStatus[]|null $historicoStatus
     * @return CreatePrePostagemResponse
     */
    public function setHistoricoStatus(?array $historicoStatus): CreatePrePostagemResponse
    {
        if (is_array($historicoStatus)) {
            $this->historicoStatus = [];

            foreach ($historicoStatus as $status) {
                $this->addHistoricoStatus($status);
            }
        } else {
            $this->historicoStatus = null;
        }

        return $this;
    }

    /**
     * @param PrePostagemHistoricoStatus|array $historicoStatus
     * @return CreatePrePostagemResponse
     */
    public function addHistoricoStatus($historicoStatus): CreatePrePostagemResponse
    {
        if (! is_array($historicoStatus) && ! $historicoStatus instanceof PrePostagemHistoricoStatus) {
            throw new InvalidArgumentException(
                'The argument must be an instance of PrePostagemHistoricoStatus or an array'
            );
        }

        if (!isset($this->historicoStatus)) {
            $this->historicoStatus = [];
        }

        $this->historicoStatus[] = PrePostagemHistoricoStatus::create($historicoStatus);

        return $this;
    }

    public function getIndicadorMalote(): ?string
    {
        return $this->indicadorMalote;
    }

    public function setIndicadorMalote(?string $indicadorMalote): CreatePrePostagemResponse
    {
        $this->indicadorMalote = $indicadorMalote;
        return $this;
    }

    public function getCodigoGrafica(): ?int
    {
        return $this->codigoGrafica;
    }

    public function setCodigoGrafica(?int $codigoGrafica): CreatePrePostagemResponse
    {
        $this->codigoGrafica = $codigoGrafica;
        return $this;
    }

    public function getCodigoRemetente(): ?string
    {
        return $this->codigoRemetente;
    }

    public function setCodigoRemetente(?string $codigoRemetente): CreatePrePostagemResponse
    {
        $this->codigoRemetente = $codigoRemetente;
        return $this;
    }

    public function getCodigoDestinatario(): ?string
    {
        return $this->codigoDestinatario;
    }

    public function setCodigoDestinatario(?string $codigoDestinatario): CreatePrePostagemResponse
    {
        $this->codigoDestinatario = $codigoDestinatario;
        return $this;
    }

    public function getMalotePrePostagem(): ?MalotePrePostagem
    {
        return $this->malotePrePostagem;
    }

    /**
     * @param MalotePrePostagem|array|null $malotePrePostagem
     * @return $this
     */
    public function setMalotePrePostagem($malotePrePostagem): CreatePrePostagemResponse
    {
        $this->malotePrePostagem = is_null($malotePrePostagem) ? null : MalotePrePostagem::create($malotePrePostagem);
        return $this;
    }

    public function getListaMalotes(): ?array
    {
        return $this->listaMalotes;
    }

    /**
     * @param MalotePrePostagem[]|null $listaMalotes
     * @return CreatePrePostagemResponse
     */
    public function setListaMalotes(?array $listaMalotes): CreatePrePostagemResponse
    {
        if (is_array($listaMalotes)) {
            $this->listaMalotes = [];

            foreach ($listaMalotes as $malote) {
                $this->addMalote($malote);
            }
        } else {
            $this->listaMalotes = null;
        }

        return $this;
    }

    /**
     * @param MalotePrePostagem|array $malote
     * @return CreatePrePostagemResponse
     */
    public function addMalote($malote): CreatePrePostagemResponse
    {
        if (! is_array($malote) && ! $malote instanceof MalotePrePostagem) {
            throw new InvalidArgumentException(
                'The argument must be an instance of MalotePrePostagem or an array'
            );
        }

        if (!isset($this->listaMalotes)) {
            $this->listaMalotes = [];
        }

        $this->listaMalotes[] = MalotePrePostagem::create($malote);

        return $this;
    }

    public function toArray(): array
    {
        return array_merge(parent::toArray(), [
            'id' => $this->getId(),
            'eticket' => $this->getEticket(),
            'dataEticket' => $this->getDataEticket() ? $this->getDataEticket()->toIso8601String() : null,
            'embalagem' => $this->getEmbalagem(),
            'servico' => $this->getServico(),
            'statusAtual' => $this->getStatusAtual(),
            'dataHoraStatusAtual' => $this->getDataHoraStatusAtual() ?
                $this->getDataHoraStatusAtual()->toIso8601String() : null,
            'descStatusAtual' => $this->getDescStatusAtual(),
            'dataHora' => $this->getDataHora() ? $this->getDataHora()->toIso8601String() : null,
            'tipoRotulo' => $this->getTipoRotulo(),
            'retornoIntegracao' => $this->getRetornoIntegracao(),
            'sistemaOrigem' => $this->getSistemaOrigem(),
            'valorTotalBens' => $this->getValorTotalBens(),
            'listaIdPrepostagemObjetos' => $this->getListaIdPrepostagemObjetos(),
            'quantidade' => $this->getQuantidade(),
            'reciboSolicitacaoAssincrona' => $this->getReciboSolicitacaoAssincrona(),
            'reciboSolicitacaoAssincronaRotulo' => $this->getReciboSolicitacaoAssincronaRotulo(),
            'codigoFormatoObjetoPreAfericao' => $this->getCodigoFormatoObjetoPreAfericao(),
            'alturaPreAfericao' => $this->getAlturaPreAfericao(),
            'larguraPreAfericao' => $this->getLarguraPreAfericao(),
            'comprimentoPreAfericao' => $this->getComprimentoPreAfericao(),
            'diametroPreAfericao' => $this->getDiametroPreAfericao(),
            'pesoPreAfericao' => $this->getPesoPreAfericao(),
            'dataHoraPreAfericao' => $this->getDataHoraPreAfericao() ?
                $this->getDataHoraPreAfericao()->toIso8601String() : null,
            'mcuUnidadePreAfericao' => $this->getMcuUnidadePreAfericao(),
            'idBalancaCubagem' => $this->getIdBalancaCubagem(),
            'cepDestinoPreAfericao' => $this->getCepDestinoPreAfericao(),
            'ehObjetoDgr' => $this->getEhObjetoDgr(),
            'tipoObjeto' => $this->getTipoObjeto(),
            'erroAssincrono' => $this->getErroAssincrono(),
            'codigoEstampa2D' => $this->getCodigoEstampa2D(),
            'historicoStatus' => $this->getHistoricoStatus()
                ? array_map(function (PrePostagemHistoricoStatus $historicoStatus) {
                    return $historicoStatus->toArray();
                }, $this->getHistoricoStatus())
                : null,
            'indicadorMalote' => $this->getIndicadorMalote(),
            'codigoGrafica' => $this->getCodigoGrafica(),
            'codigoRemetente' => $this->getCodigoRemetente(),
            'codigoDestinatario' => $this->getCodigoDestinatario(),
            'malotePrePostagem' => $this->getMalotePrePostagem() ? $this->getMalotePrePostagem()->toArray() : null,
            'listaMalotes' => $this->getListaMalotes()
                ? array_map(function (MalotePrePostagem $malote) {
                    return $malote->toArray();
                }, $this->getListaMalotes())
                : null,
        ]);
    }
}
