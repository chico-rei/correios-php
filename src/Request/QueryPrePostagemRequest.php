<?php

namespace ChicoRei\Packages\Correios\Request;

use Carbon\Carbon;
use ChicoRei\Packages\Correios\CorreiosObject;

class QueryPrePostagemRequest extends CorreiosObject implements CorreiosRequest
{
    /**
     * ID da pré-postagem. Caso seja informado, apenas este parâmetro será considerado na consulta.
     */
    public ?string $id = null;

    /**
     * Código identificador do objeto. Caso seja informado e não seja informado Id,
     * apenas este parâmetro será considerado na consulta.
    */
    public ?string $codigoObjeto = null;

    /**
     * E-Ticket. Caso seja informado e não seja informado Id e Código de Objeto, apenas este parâmetro
     * será considerado na consulta.
    */
    public ?string $eTicket = null;

    /**
     * Código estampa 2D de objeto franqueado pela máquina. Caso seja informado e não seja informado Id,
     * Código de Objeto e E-ticket , apenas este parametro será considerado na consulta.
    */
    public ?string $codigoEstampa2D = null;

    /**
     * IdCorreios do cliente que gerou a pré-postagem à vista. Caso seja informado, é obrigatório informar Status.
     */
    public ?string $idCorreios = null;

    /**
     * Status da pré-postagem. Se não for informado parâmetro de Id/Código/Eticket, se torna obrigatório.
     * Available values : PREATENDIDO, PREPOSTADO, POSTADO, EXPIRADO, CANCELADO, ESTORNADO
    */
    public ?string $status = null;

    /**
     * Indicador de logística reversa. (S)=Sim, (N)=Não. Caso seja informado, é obrigatório informar status.
     */
    public ?string $logisticaReversa = null;

    /**
     * Tipo de objeto. Indica se a consulta deve retornar objetos Simples, Registrados ou Todos. Caso seja informado,
     * é obrigatório informar também outros parâmetros, como Status.
     * Available values : TODOS, SIMPLES, REGISTRADO
     */
    public ?string $tipoObjeto = null;

    /**
     * Modalidade Pagamento: A_VISTA, A_FATURAR, A_VISTA_FATURAR ou PRESTACAO_CONTAS_REC_PAG. Caso seja informado,
     * * é obrigatório informar também outros parâmetros, como status.
     */
    public ?string $modalidadePagamento = null;

    /**
     * Indicador de objeto Cargo. (S)=Sim, (N)=Não.
     */
    public ?string $objetoCargo = null;

    /**
     * Data Inicial da Pré-postagem no formato AAAA-MM-DD. Quando o status for PREPOSTADO ou PREATENDIDO,
     * não é necessário informar a data, apenas o status; Ao informar o código do objeto, não é necessário informar a
     * data, apenas o código; Quando informado, o filtro de data será sempre limitado a 30 dias; Para status
     * diferentes de PREPOSTADO ou PREATENDIDO, os campos de data são obrigatórios.
     */
    public ?Carbon $dataInicialCriacaoPrePostagem = null;

    /**
     * Data Final da Pré-postagem no formato AAAA-MM-DD. Quando o status for PREPOSTADO ou PREATENDIDO,
     * não é necessário informar a data, apenas o status; Ao informar o código do objeto, não é necessário informar a
     * data, apenas o código; Quando informado, o filtro de data será sempre limitado a 30 dias; Para status
     * diferentes de PREPOSTADO ou PREATENDIDO, os campos de data são obrigatórios.
     */
    public ?Carbon $dataFinalCriacaoPrePostagem = null;

    /**
     * Número da página
     */
    public ?string $page = null;

    /**
     * Tamanho da página
     */
    public ?string $size = null;

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(?string $id): QueryPrePostagemRequest
    {
        $this->id = $id;
        return $this;
    }

    public function getCodigoObjeto(): ?string
    {
        return $this->codigoObjeto;
    }

    public function setCodigoObjeto(?string $codigoObjeto): QueryPrePostagemRequest
    {
        $this->codigoObjeto = $codigoObjeto;
        return $this;
    }

    public function getETicket(): ?string
    {
        return $this->eTicket;
    }

    public function setETicket(?string $eTicket): QueryPrePostagemRequest
    {
        $this->eTicket = $eTicket;
        return $this;
    }

    public function getCodigoEstampa2D(): ?string
    {
        return $this->codigoEstampa2D;
    }

    public function setCodigoEstampa2D(?string $codigoEstampa2D): QueryPrePostagemRequest
    {
        $this->codigoEstampa2D = $codigoEstampa2D;
        return $this;
    }

    public function getIdCorreios(): ?string
    {
        return $this->idCorreios;
    }

    public function setIdCorreios(?string $idCorreios): QueryPrePostagemRequest
    {
        $this->idCorreios = $idCorreios;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): QueryPrePostagemRequest
    {
        $this->status = $status;
        return $this;
    }

    public function getLogisticaReversa(): ?string
    {
        return $this->logisticaReversa;
    }

    public function setLogisticaReversa(?string $logisticaReversa): QueryPrePostagemRequest
    {
        $this->logisticaReversa = $logisticaReversa;
        return $this;
    }

    public function getTipoObjeto(): ?string
    {
        return $this->tipoObjeto;
    }

    public function setTipoObjeto(?string $tipoObjeto): QueryPrePostagemRequest
    {
        $this->tipoObjeto = $tipoObjeto;
        return $this;
    }

    public function getModalidadePagamento(): ?string
    {
        return $this->modalidadePagamento;
    }

    public function setModalidadePagamento(?string $modalidadePagamento): QueryPrePostagemRequest
    {
        $this->modalidadePagamento = $modalidadePagamento;
        return $this;
    }

    public function getObjetoCargo(): ?string
    {
        return $this->objetoCargo;
    }

    public function setObjetoCargo(?string $objetoCargo): QueryPrePostagemRequest
    {
        $this->objetoCargo = $objetoCargo;
        return $this;
    }

    public function getDataInicialCriacaoPrePostagem(): ?Carbon
    {
        return $this->dataInicialCriacaoPrePostagem;
    }

    public function setDataInicialCriacaoPrePostagem(?Carbon $dataInicialCriacaoPrePostagem): QueryPrePostagemRequest
    {
        $this->dataInicialCriacaoPrePostagem = $dataInicialCriacaoPrePostagem;
        return $this;
    }

    public function getDataFinalCriacaoPrePostagem(): ?Carbon
    {
        return $this->dataFinalCriacaoPrePostagem;
    }

    public function setDataFinalCriacaoPrePostagem(?Carbon $dataFinalCriacaoPrePostagem): QueryPrePostagemRequest
    {
        $this->dataFinalCriacaoPrePostagem = $dataFinalCriacaoPrePostagem;
        return $this;
    }

    public function getPage(): ?string
    {
        return $this->page;
    }

    public function setPage(?string $page): QueryPrePostagemRequest
    {
        $this->page = $page;
        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): QueryPrePostagemRequest
    {
        $this->size = $size;
        return $this;
    }

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getPath(): string
    {
        return '/prepostagem/v2/prepostagens';
    }

    public function getPayload(): ?array
    {
        return null;
    }

    public function getQuery(): ?array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'codigoObjeto' => $this->getCodigoObjeto(),
            'eTicket' => $this->getETicket(),
            'codigoEstampa2D' => $this->getCodigoEstampa2D(),
            'idCorreios' => $this->getIdCorreios(),
            'status' => $this->getStatus(),
            'logisticaReversa' => $this->getLogisticaReversa(),
            'tipoObjeto' => $this->getTipoObjeto(),
            'modalidadePagamento' => $this->getModalidadePagamento(),
            'objetoCargo' => $this->getObjetoCargo(),
            'dataInicialCriacaoPrePostagem' => $this->getDataInicialCriacaoPrePostagem()
                ? $this->getDataInicialCriacaoPrePostagem()->format('Y-m-d')
                : null,
            'dataFinalCriacaoPrePostagem' => $this->getDataFinalCriacaoPrePostagem()
                ? $this->getDataFinalCriacaoPrePostagem()->format('Y-m-d')
                : null,
            'page' => $this->getPage(),
            'size' => $this->getSize(),
        ];
    }
}
