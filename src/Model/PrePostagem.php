<?php

namespace ChicoRei\Packages\Correios\Model;

use Carbon\Carbon;
use ChicoRei\Packages\Correios\CorreiosObject;
use InvalidArgumentException;

abstract class PrePostagem extends CorreiosObject
{
    /**
     * Identificador do usuário no IDCorreios. Obrigatório apenas para credenciais INTERNAS.
     */
    public ?string $idCorreios = null;

    /**
     * Dados do remetente.
     */
    public ?Remetente $remetente = null;

    /**
     * Dados do destinatário.
     */
    public ?Destinatario $destinatario = null;

    /**
     * Código identificador do objeto. Tamanho máximo: 13 caracteres.
     */
    public ?string $codigoObjeto = null;

    /**
     * Código do serviço a ser pré-postado. Não pode ser deixado em branco.
     * Tem que ser um código de serviço válido.
     * O código do serviço deve constar no cartão de postagem do cliente que está fazendo a pré-postagem
     */
    public ?string $codigoServico = null;

    /**
     * Serviços Adicionais.
     *
     * @var ServicoAdicional[]|null
     */
    public ?array $listaServicoAdicional = null;

    /**
     * Modalidade Pagamento: 1-à vista, 2-à faturar, 3- à avista e à afaturar
     * e 4- Prestação de contas recebimento ou pagamento.
     */
    public ?int $modalidadePagamento = null;

    /**
     * Preço somente do serviço, sem os adicionais. Utilizado apenas em credenciais INTERNAS.
     */
    public ?float $precoServico = null;

    /**
     * Preço total da pré-postagem. Utilizado apenas em credenciais INTERNAS.
     */
    public ?float $precoPrePostagem = null;

    /**
     * Número da nota fiscal que acompanhará o objeto pré-postado.
     * Obrigatório, na ausência da declaração de conteúdo ou NFe. Tamanho máximo: 12 caracteres numéricos.
     */
    public ?string $numeroNotaFiscal = null;

    /**
     * Chave da Nota Fiscal Eletrônica. Obrigatório, na ausência da declaração de conteúdo ou NF.
     * Se informado, deverá conter 44 caracteres numéricos.
     */
    public ?string $chaveNFe = null;

    /**
     * Itens da declaração de conteúdo. Obrigatório, na ausência da NF ou NFe.
     *
     * @var ItemDeclaracaoConteudo[]|null
     */
    public ?array $itensDeclaracaoConteudo = null;

    /**
     * Peso em gramas do objeto que será pré-postado. Não pode ser deixado em branco.
     * Não pode ser zero. Não pode ser um valor negativo.
     * Não pode exceder o limite máximo definido para o serviço informado. Tamanho máximo: 6 dígitos.
     */
    public ?string $pesoInformado = null;

    /**
     * Código do formato do objeto a ser pré-postado. Não pode ser deixado em branco.
     * Deve ser um dos códigos a seguir: 1-Envelope; 2-Caixa/Pacote; 3-Cilindro/rolo.
     */
    public ?string $codigoFormatoObjetoInformado = null;

    /**
     * Dimensão altura do objeto a ser pré-postado. Obrigatório para o formato caixa/pacote.
     * Deve ser informada em centímetros. Não deve ser menor que o limite mínimo nem maior do que o
     * limite máximo definido para o serviço informado. Tamanho máximo: 3 dígitos.
     */
    public ?string $alturaInformada = null;

    /**
     * Dimensão largura do objeto a ser pré-postado. Obrigatório para o formato caixa/pacote.
     * Deve ser informada em centímetros. Não deve ser menor que o limite mínimo nem maior do que
     * o limite máximo definido para o serviço informado. Tamanho máximo: 3 dígitos.
     */
    public ?string $larguraInformada = null;

    /**
     * Dimensão comprimento do objeto a ser pré-postado. Obrigatório para o formato caixa/pacote.
     * Deve ser informado em centímetros. Não deve ser menor que o limite mínimo nem maior do que o
     * limite máximo definido para o serviço informado. Tamanho máximo: 3 dígitos.
     */
    public ?string $comprimentoInformado = null;

    /**
     * Dimensão diâmetro do objeto a ser pré-postado. Obrigatório para o formato cilindro /rolo.
     * Deve ser informado em centímetros. Não deve ser menor que o limite mínimo nem maior do que o
     * limite máximo definido para o serviço informado. Tamanho máximo: 3 dígitos.
     */
    public ?string $diametroInformado = null;

    /**
     * Código NCM (Nomenclatura Comum do Mercosul) do produto que está sendo pré-postado.
     * Se informado deve conter até 8 caracteres numéricos.
     */
    public ?string $ncmObjeto = null;

    /**
     * Código SSCC (do inglês Serial Shipping Container Code ou traduzindo Código de Séria de
     * Unidade Logística) associado à TAG RFID afixado no objeto que está sendo pré-postado.
     * Se informado deverá ter até 20 caracteres numéricos.
     */
    public ?string $rfidObjeto = null;

    /**
     * Atributo que indica que o objeto a ser pré-postado é permitido no fluxo postal.
     * Não pode ser deixada em branco. Deverá ser informado "0" ou "1".
     * Onde  "0" – Indica que o cliente está pré-postando um objeto proibido no fluxo postal e
     * "1" – Indica que o cliente está pré-postando um objeto permitido no fluxo postal
     */
    public ?int $cienteObjetoNaoProibido = null;

    /**
     * ID do atendimento. Utilizado apenas em credenciais INTERNAS
     */
    public ?string $idAtendimento = null;

    /**
     * Indica se o objeto vai ter uma coleta gerada, valores possíveis: S ou N.
     */
    public ?string $solicitarColeta = null;

    /**
     * Data provável da postagem (obrigatório apenas para o segmento de mensagem).
     */
    public ?Carbon $dataPrevistaPostagem = null;

    /**
     * Informações complementares. Tamanho máximo: 50 caracteres.
     */
    public ?string $observacao = null;

    /**
     * Indicador se possui ou não logística reversa: S= Sim, N= Não.
     */
    public ?string $logisticaReversa = null;

    /**
     * Data de validade da logistica reversa.
     */
    public ?Carbon $dataValidadeLogReversa = null;

    /**
     * Data de limite para postagem do objeto. Após essa data, caso o objeto não seja postado,
     * o mesmo será expirado. Data default será a data de criação + 14 dias, caso não seja informada.
     * Data máxima de 90 dias a contar da data de criação.
     */
    public ?Carbon $prazoPostagem = null;

    /**
     * Identifica o código de pedido do cliente junto à plataforma externa.
     */
    public ?string $pedidoExternoOrigem = null;

    /**
     * Identifica o canal de acesso utilizado pelo cliente externo ao acessar serviço.
     */
    public ?string $canalExternoOrigem = null;

    /**
     * Identificador do usuário no IDCorreios. Obrigatório apenas para credenciais INTERNAS.
     */
    public ?string $numeroCartaoPostagem = null;

    public function getIdCorreios(): ?string
    {
        return $this->idCorreios;
    }

    public function setIdCorreios(?string $idCorreios): PrePostagem
    {
        $this->idCorreios = $idCorreios;
        return $this;
    }

    public function getRemetente(): ?Remetente
    {
        return $this->remetente;
    }

    /**
     * @param Remetente|array|null $remetente
     * @return $this
     */
    public function setRemetente($remetente): PrePostagem
    {
        $this->remetente = is_null($remetente) ? null : Remetente::create($remetente);
        return $this;
    }

    public function getDestinatario(): ?Destinatario
    {
        return $this->destinatario;
    }

    /**
     * @param Destinatario|array|null $destinatario
     * @return $this
     */
    public function setDestinatario($destinatario): PrePostagem
    {
        $this->destinatario = is_null($destinatario) ? null : Destinatario::create($destinatario);
        return $this;
    }

    public function getCodigoObjeto(): ?string
    {
        return $this->codigoObjeto;
    }

    public function setCodigoObjeto(?string $codigoObjeto): PrePostagem
    {
        $this->codigoObjeto = $codigoObjeto;
        return $this;
    }

    public function getCodigoServico(): ?string
    {
        return $this->codigoServico;
    }

    public function setCodigoServico(?string $codigoServico): PrePostagem
    {
        $this->codigoServico = $codigoServico;
        return $this;
    }

    public function getListaServicoAdicional(): ?array
    {
        return $this->listaServicoAdicional;
    }

    /**
     * @param ServicoAdicional[]|array|null $listaServicoAdicional
     * @return $this
     */
    public function setListaServicoAdicional(?array $listaServicoAdicional): PrePostagem
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
    public function addServicoAdicional($servicoAdicional): PrePostagem
    {
        if (! is_array($servicoAdicional) && ! $servicoAdicional instanceof ServicoAdicional) {
            throw new InvalidArgumentException('The argument must be an instance of ServicoAdicional or an array');
        }

        if (!isset($this->listaServicoAdicional)) {
            $this->listaServicoAdicional = [];
        }

        $this->listaServicoAdicional[] = ServicoAdicional::create($servicoAdicional);

        return $this;
    }

    public function getModalidadePagamento(): ?int
    {
        return $this->modalidadePagamento;
    }

    public function setModalidadePagamento(?int $modalidadePagamento): PrePostagem
    {
        $this->modalidadePagamento = $modalidadePagamento;
        return $this;
    }

    public function getPrecoServico(): ?float
    {
        return $this->precoServico;
    }

    public function setPrecoServico(?float $precoServico): PrePostagem
    {
        $this->precoServico = $precoServico;
        return $this;
    }

    public function getPrecoPrePostagem(): ?float
    {
        return $this->precoPrePostagem;
    }

    public function setPrecoPrePostagem(?float $precoPrePostagem): PrePostagem
    {
        $this->precoPrePostagem = $precoPrePostagem;
        return $this;
    }

    public function getNumeroNotaFiscal(): ?string
    {
        return $this->numeroNotaFiscal;
    }

    public function setNumeroNotaFiscal(?string $numeroNotaFiscal): PrePostagem
    {
        $this->numeroNotaFiscal = $numeroNotaFiscal;
        return $this;
    }

    public function getChaveNFe(): ?string
    {
        return $this->chaveNFe;
    }

    public function setChaveNFe(?string $chaveNFe): PrePostagem
    {
        $this->chaveNFe = $chaveNFe;
        return $this;
    }

    public function getItensDeclaracaoConteudo(): ?array
    {
        return $this->itensDeclaracaoConteudo;
    }

    public function setItensDeclaracaoConteudo(?array $itensDeclaracaoConteudo): PrePostagem
    {
        if (is_array($itensDeclaracaoConteudo)) {
            $this->itensDeclaracaoConteudo = [];

            foreach ($itensDeclaracaoConteudo as $itemDeclaracaoConteudo) {
                $this->addItemDeclaracaoConteudo($itemDeclaracaoConteudo);
            }
        } else {
            $this->itensDeclaracaoConteudo = null;
        }

        return $this;
    }

    /**
     * @param ItemDeclaracaoConteudo|array $itemDeclaracaoConteudo
     */
    public function addItemDeclaracaoConteudo($itemDeclaracaoConteudo): PrePostagem
    {
        if (! is_array($itemDeclaracaoConteudo) && ! $itemDeclaracaoConteudo instanceof ItemDeclaracaoConteudo) {
            throw new InvalidArgumentException(
                'The argument must be an instance of ItemDeclaracaoConteudo or an array'
            );
        }

        if (!isset($this->itensDeclaracaoConteudo)) {
            $this->itensDeclaracaoConteudo = [];
        }

        $this->itensDeclaracaoConteudo[] = ItemDeclaracaoConteudo::create($itemDeclaracaoConteudo);

        return $this;
    }

    public function getPesoInformado(): ?string
    {
        return $this->pesoInformado;
    }

    public function setPesoInformado(?string $pesoInformado): PrePostagem
    {
        $this->pesoInformado = $pesoInformado;
        return $this;
    }

    public function getCodigoFormatoObjetoInformado(): ?string
    {
        return $this->codigoFormatoObjetoInformado;
    }

    public function setCodigoFormatoObjetoInformado(?string $codigoFormatoObjetoInformado): PrePostagem
    {
        $this->codigoFormatoObjetoInformado = $codigoFormatoObjetoInformado;
        return $this;
    }

    public function getAlturaInformada(): ?string
    {
        return $this->alturaInformada;
    }

    public function setAlturaInformada(?string $alturaInformada): PrePostagem
    {
        $this->alturaInformada = $alturaInformada;
        return $this;
    }

    public function getLarguraInformada(): ?string
    {
        return $this->larguraInformada;
    }

    public function setLarguraInformada(?string $larguraInformada): PrePostagem
    {
        $this->larguraInformada = $larguraInformada;
        return $this;
    }

    public function getComprimentoInformado(): ?string
    {
        return $this->comprimentoInformado;
    }

    public function setComprimentoInformado(?string $comprimentoInformado): PrePostagem
    {
        $this->comprimentoInformado = $comprimentoInformado;
        return $this;
    }

    public function getDiametroInformado(): ?string
    {
        return $this->diametroInformado;
    }

    public function setDiametroInformado(?string $diametroInformado): PrePostagem
    {
        $this->diametroInformado = $diametroInformado;
        return $this;
    }

    public function getNcmObjeto(): ?string
    {
        return $this->ncmObjeto;
    }

    public function setNcmObjeto(?string $ncmObjeto): PrePostagem
    {
        $this->ncmObjeto = $ncmObjeto;
        return $this;
    }

    public function getRfidObjeto(): ?string
    {
        return $this->rfidObjeto;
    }

    public function setRfidObjeto(?string $rfidObjeto): PrePostagem
    {
        $this->rfidObjeto = $rfidObjeto;
        return $this;
    }

    public function getCienteObjetoNaoProibido(): ?int
    {
        return $this->cienteObjetoNaoProibido;
    }

    public function setCienteObjetoNaoProibido(?int $cienteObjetoNaoProibido): PrePostagem
    {
        $this->cienteObjetoNaoProibido = $cienteObjetoNaoProibido;
        return $this;
    }

    public function getIdAtendimento(): ?string
    {
        return $this->idAtendimento;
    }

    public function setIdAtendimento(?string $idAtendimento): PrePostagem
    {
        $this->idAtendimento = $idAtendimento;
        return $this;
    }

    public function getSolicitarColeta(): ?string
    {
        return $this->solicitarColeta;
    }

    public function setSolicitarColeta(?string $solicitarColeta): PrePostagem
    {
        $this->solicitarColeta = $solicitarColeta;
        return $this;
    }

    public function getDataPrevistaPostagem(): ?Carbon
    {
        return $this->dataPrevistaPostagem;
    }

    /**
     * @param Carbon|string|null $dataPrevistaPostagem
     * @return $this
     */
    public function setDataPrevistaPostagem($dataPrevistaPostagem): PrePostagem
    {
        $this->dataPrevistaPostagem = is_null($dataPrevistaPostagem) ? null : Carbon::parse($dataPrevistaPostagem);
        return $this;
    }

    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    public function setObservacao(?string $observacao): PrePostagem
    {
        $this->observacao = $observacao;
        return $this;
    }

    public function getLogisticaReversa(): ?string
    {
        return $this->logisticaReversa;
    }

    public function setLogisticaReversa(?string $logisticaReversa): PrePostagem
    {
        $this->logisticaReversa = $logisticaReversa;
        return $this;
    }

    public function getDataValidadeLogReversa(): ?Carbon
    {
        return $this->dataValidadeLogReversa;
    }

    /**
     * @param Carbon|String|null $dataValidadeLogReversa
     * @return $this
     */
    public function setDataValidadeLogReversa($dataValidadeLogReversa): PrePostagem
    {
        $this->dataValidadeLogReversa = is_null($dataValidadeLogReversa) ?
            null : Carbon::parse($dataValidadeLogReversa);
        return $this;
    }

    public function getPrazoPostagem(): ?Carbon
    {
        return $this->prazoPostagem;
    }

    /**
     * @param Carbon|string|null $prazoPostagem
     * @return $this
     */
    public function setPrazoPostagem($prazoPostagem): PrePostagem
    {
        $this->prazoPostagem = is_null($prazoPostagem) ? null : Carbon::parse($prazoPostagem);
        return $this;
    }

    public function getPedidoExternoOrigem(): ?string
    {
        return $this->pedidoExternoOrigem;
    }

    public function setPedidoExternoOrigem(?string $pedidoExternoOrigem): PrePostagem
    {
        $this->pedidoExternoOrigem = $pedidoExternoOrigem;
        return $this;
    }

    public function getCanalExternoOrigem(): ?string
    {
        return $this->canalExternoOrigem;
    }

    public function setCanalExternoOrigem(?string $canalExternoOrigem): PrePostagem
    {
        $this->canalExternoOrigem = $canalExternoOrigem;
        return $this;
    }

    public function getNumeroCartaoPostagem(): ?string
    {
        return $this->numeroCartaoPostagem;
    }

    public function setNumeroCartaoPostagem(?string $numeroCartaoPostagem): PrePostagem
    {
        $this->numeroCartaoPostagem = $numeroCartaoPostagem;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'idCorreios' => $this->getIdCorreios(),
            'remetente' => $this->getRemetente() ? $this->getRemetente()->toArray() : null,
            'destinatario' => $this->getDestinatario() ? $this->getDestinatario()->toArray() : null,
            'codigoServico' => $this->getCodigoServico(),
            'precoServico' => $this->getPrecoServico(),
            'precoPrePostagem' => $this->getPrecoPrePostagem(),
            'numeroNotaFiscal' => $this->getNumeroNotaFiscal(),
            'chaveNFe' => $this->getChaveNFe(),
            'listaServicoAdicional' => $this->getListaServicoAdicional()
                ? array_map(function (ServicoAdicional $servicoAdicional) {
                    return $servicoAdicional->toArray();
                }, $this->getListaServicoAdicional())
                : null,
            'itensDeclaracaoConteudo' => $this->getItensDeclaracaoConteudo()
                ? array_map(function (ItemDeclaracaoConteudo $itemDeclaracaoConteudo) {
                    return $itemDeclaracaoConteudo->toArray();
                }, $this->getItensDeclaracaoConteudo())
                : null,
            'pesoInformado' => $this->getPesoInformado(),
            'codigoFormatoObjetoInformado' => $this->getCodigoFormatoObjetoInformado(),
            'alturaInformada' => $this->getAlturaInformada(),
            'larguraInformada' => $this->getLarguraInformada(),
            'comprimentoInformado' => $this->getComprimentoInformado(),
            'diametroInformado' => $this->getDiametroInformado(),
            'ncmObjeto' => $this->getNcmObjeto(),
            'rfidObjeto' => $this->getRfidObjeto(),
            'cienteObjetoNaoProibido' => $this->getCienteObjetoNaoProibido(),
            'idAtendimento' => $this->getIdAtendimento(),
            'solicitarColeta' => $this->getSolicitarColeta(),
            'codigoObjeto' => $this->getCodigoObjeto(),
            'dataPrevistaPostagem' => $this->getDataPrevistaPostagem() ?
                $this->getDataPrevistaPostagem()->format('d/m/Y') : null,
            'observacao' => $this->getObservacao(),
            'modalidadePagamento' => $this->getModalidadePagamento(),
            'logisticaReversa' => $this->getLogisticaReversa(),
            'dataValidadeLogReversa' => $this->getDataValidadeLogReversa() ?
                $this->getDataValidadeLogReversa()->format('d/m/Y') : null,
            'prazoPostagem' => $this->getPrazoPostagem() ?
                $this->getPrazoPostagem()->format('d/m/Y') : null,
            'canalExternoOrigem' => $this->getCanalExternoOrigem(),
            'pedidoExternoOrigem' => $this->getPedidoExternoOrigem(),
            'numeroCartaoPostagem' => $this->getNumeroCartaoPostagem(),
        ];
    }
}
