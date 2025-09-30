<?php

namespace ChicoRei\Packages\Correios\Response;

use ChicoRei\Packages\Correios\CorreiosObject;
use ChicoRei\Packages\Correios\Model\FaixaCaixaPostal;
use InvalidArgumentException;

class CepResponse extends CorreiosObject
{
    /**
     * CEP: Código de endereçamento postal
     */
    public ?string $cep = null;

    /**
     * Sigla da UF
     */
    public ?string $uf = null;

    /**
     * Número da localidade referente ao CEP
     */
    public ?int $numeroLocalidade = null;

    /**
     * Localidade
     */
    public ?string $localidade = null;

    /**
     * Logradouro
     */
    public ?string $logradouro = null;

    /**
     * Tipo de logradouro: avenida, rua, conjunto, fazenda
     */
    public ?string $tipoLogradouro = null;

    /**
     * Nome do logradouro
     */
    public ?string $nomeLogradouro = null;

    /**
     * Número do logradouro
     */
    public ?string $numeroLogradouro = null;

    /**
     * Complemento
     */
    public ?string $complemento = null;

    /**
     * Abreviatura
     */
    public ?string $abreviatura = null;

    /**
     * Bairro
     */
    public ?string $bairro = null;

    /**
     * Número da localidade superior
     */
    public ?int $numeroLocalidadeSuperior = null;

    /**
     * Nome da localidade superior
     */
    public ?string $localidadeSuperior = null;

    /**
     * Nome de grandes usuários
     */
    public ?string $nome = null;

    /**
     * Sigla da unidade
     */
    public ?string $siglaUnidade = null;

    /**
     * Tipo do CEP.
     * 1: Localidade;
     * 2: Logradouro;
     * 3: CEP Promocional;
     * 4: Caixa Postal Comunitária;
     * 5: Grande Usuário;
     * 6: Unidade Operacional
     */
    public ?int $tipoCEP = null;

    /**
     * Número do CEP anterior
     */
    public ?string $cepAnterior = null;

    /**
     * Distrito Postal
     */
    public ?string $distrito = null;

    /**
     * CEP da unidade operacional
     */
    public ?string $cepUnidadeOperacional = null;

    /**
     * Lado
     */
    public ?string $lado = null;

    /**
     * Número inicial
     */
    public ?int $numeroInicial = null;

    /**
     * Número final
     */
    public ?int $numeroFinal = null;

    /**
     * Indica que é uma unidade de Clique e Retire
     */
    public ?string $clique = null;

    /**
     * Faixas de Caixa Postal
     * @var FaixaCaixaPostal[]|null
     */
    public ?array $caixasPostais = null;

    /**
     * Indica que é uma unidade de locker
     */
    public ?string $locker = null;

    /**
     * Indica que é uma unidade de agência modular
     */
    public ?string $agenciaModular = null;

    /**
     * Descrição da mensagem
     */
    public ?string $txMsg = null;

    /**
     * Situação da localidade: 0 = Não codificada, 3 = Em fase de codificação
     */
    public ?string $inSituacaoLocalidade = null;

    /**
     * Data final de vigência
     */
    public ?string $dtFinalVigencia = null;

    public function getCep(): ?string
    {
        return $this->cep;
    }

    public function setCep(?string $cep): CepResponse
    {
        $this->cep = $cep;
        return $this;
    }

    public function getUf(): ?string
    {
        return $this->uf;
    }

    public function setUf(?string $uf): CepResponse
    {
        $this->uf = $uf;
        return $this;
    }

    public function getNumeroLocalidade(): ?int
    {
        return $this->numeroLocalidade;
    }

    public function setNumeroLocalidade(?int $numeroLocalidade): CepResponse
    {
        $this->numeroLocalidade = $numeroLocalidade;
        return $this;
    }

    public function getLocalidade(): ?string
    {
        return $this->localidade;
    }

    public function setLocalidade(?string $localidade): CepResponse
    {
        $this->localidade = $localidade;
        return $this;
    }

    public function getLogradouro(): ?string
    {
        return $this->logradouro;
    }

    public function setLogradouro(?string $logradouro): CepResponse
    {
        $this->logradouro = $logradouro;
        return $this;
    }

    public function getTipoLogradouro(): ?string
    {
        return $this->tipoLogradouro;
    }

    public function setTipoLogradouro(?string $tipoLogradouro): CepResponse
    {
        $this->tipoLogradouro = $tipoLogradouro;
        return $this;
    }

    public function getNomeLogradouro(): ?string
    {
        return $this->nomeLogradouro;
    }

    public function setNomeLogradouro(?string $nomeLogradouro): CepResponse
    {
        $this->nomeLogradouro = $nomeLogradouro;
        return $this;
    }

    public function getNumeroLogradouro(): ?string
    {
        return $this->numeroLogradouro;
    }

    public function setNumeroLogradouro(?string $numeroLogradouro): CepResponse
    {
        $this->numeroLogradouro = $numeroLogradouro;
        return $this;
    }

    public function getComplemento(): ?string
    {
        return $this->complemento;
    }

    public function setComplemento(?string $complemento): CepResponse
    {
        $this->complemento = $complemento;
        return $this;
    }

    public function getAbreviatura(): ?string
    {
        return $this->abreviatura;
    }

    public function setAbreviatura(?string $abreviatura): CepResponse
    {
        $this->abreviatura = $abreviatura;
        return $this;
    }

    public function getBairro(): ?string
    {
        return $this->bairro;
    }

    public function setBairro(?string $bairro): CepResponse
    {
        $this->bairro = $bairro;
        return $this;
    }

    public function getNumeroLocalidadeSuperior(): ?int
    {
        return $this->numeroLocalidadeSuperior;
    }

    public function setNumeroLocalidadeSuperior(?int $numeroLocalidadeSuperior): CepResponse
    {
        $this->numeroLocalidadeSuperior = $numeroLocalidadeSuperior;
        return $this;
    }

    public function getLocalidadeSuperior(): ?string
    {
        return $this->localidadeSuperior;
    }

    public function setLocalidadeSuperior(?string $localidadeSuperior): CepResponse
    {
        $this->localidadeSuperior = $localidadeSuperior;
        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): CepResponse
    {
        $this->nome = $nome;
        return $this;
    }

    public function getSiglaUnidade(): ?string
    {
        return $this->siglaUnidade;
    }

    public function setSiglaUnidade(?string $siglaUnidade): CepResponse
    {
        $this->siglaUnidade = $siglaUnidade;
        return $this;
    }

    public function getTipoCEP(): ?int
    {
        return $this->tipoCEP;
    }

    public function setTipoCEP(?int $tipoCEP): CepResponse
    {
        $this->tipoCEP = $tipoCEP;
        return $this;
    }

    public function getCepAnterior(): ?string
    {
        return $this->cepAnterior;
    }

    public function setCepAnterior(?string $cepAnterior): CepResponse
    {
        $this->cepAnterior = $cepAnterior;
        return $this;
    }

    public function getDistrito(): ?string
    {
        return $this->distrito;
    }

    public function setDistrito(?string $distrito): CepResponse
    {
        $this->distrito = $distrito;
        return $this;
    }

    public function getCepUnidadeOperacional(): ?string
    {
        return $this->cepUnidadeOperacional;
    }

    public function setCepUnidadeOperacional(?string $cepUnidadeOperacional): CepResponse
    {
        $this->cepUnidadeOperacional = $cepUnidadeOperacional;
        return $this;
    }

    public function getLado(): ?string
    {
        return $this->lado;
    }

    public function setLado(?string $lado): CepResponse
    {
        $this->lado = $lado;
        return $this;
    }

    public function getNumeroInicial(): ?int
    {
        return $this->numeroInicial;
    }

    public function setNumeroInicial(?int $numeroInicial): CepResponse
    {
        $this->numeroInicial = $numeroInicial;
        return $this;
    }

    public function getNumeroFinal(): ?int
    {
        return $this->numeroFinal;
    }

    public function setNumeroFinal(?int $numeroFinal): CepResponse
    {
        $this->numeroFinal = $numeroFinal;
        return $this;
    }

    public function getClique(): ?string
    {
        return $this->clique;
    }

    public function setClique(?string $clique): CepResponse
    {
        $this->clique = $clique;
        return $this;
    }

    /**
     * @return FaixaCaixaPostal[]|null
     */
    public function getCaixasPostais(): ?array
    {
        return $this->caixasPostais;
    }

    /**
     * @param FaixaCaixaPostal[]|null $caixasPostais
     * @return CepResponse
     */
    public function setCaixasPostais(?array $caixasPostais): CepResponse
    {
        if (is_array($caixasPostais)) {
            $this->caixasPostais = [];

            foreach ($caixasPostais as $faixaCaixaPostal) {
                $this->addCaixaPostal($faixaCaixaPostal);
            }
        } else {
            $this->caixasPostais = null;
        }

        return $this;
    }

    /**
     * @param FaixaCaixaPostal|array $faixaCaixaPostal
     * @return CepResponse
     */
    public function addCaixaPostal($faixaCaixaPostal): CepResponse
    {
        if (! is_array($faixaCaixaPostal) && ! $faixaCaixaPostal instanceof FaixaCaixaPostal) {
            throw new InvalidArgumentException('The argument must be an instance of FaixaCaixaPostal or an array');
        }

        if (!isset($this->caixasPostais)) {
            $this->caixasPostais = [];
        }

        $this->caixasPostais[] = FaixaCaixaPostal::create($faixaCaixaPostal);

        return $this;
    }

    public function getLocker(): ?string
    {
        return $this->locker;
    }

    public function setLocker(?string $locker): CepResponse
    {
        $this->locker = $locker;
        return $this;
    }

    public function getAgenciaModular(): ?string
    {
        return $this->agenciaModular;
    }

    public function setAgenciaModular(?string $agenciaModular): CepResponse
    {
        $this->agenciaModular = $agenciaModular;
        return $this;
    }

    public function getTxMsg(): ?string
    {
        return $this->txMsg;
    }

    public function setTxMsg(?string $txMsg): CepResponse
    {
        $this->txMsg = $txMsg;
        return $this;
    }

    public function getInSituacaoLocalidade(): ?string
    {
        return $this->inSituacaoLocalidade;
    }

    public function setInSituacaoLocalidade(?string $inSituacaoLocalidade): CepResponse
    {
        $this->inSituacaoLocalidade = $inSituacaoLocalidade;
        return $this;
    }

    public function getDtFinalVigencia(): ?string
    {
        return $this->dtFinalVigencia;
    }

    public function setDtFinalVigencia(?string $dtFinalVigencia): CepResponse
    {
        $this->dtFinalVigencia = $dtFinalVigencia;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function toArray(): array
    {
        return [
            'cep' => $this->getCep(),
            'uf' => $this->getUf(),
            'numeroLocalidade' => $this->getNumeroLocalidade(),
            'localidade' => $this->getLocalidade(),
            'logradouro' => $this->getLogradouro(),
            'tipoLogradouro' => $this->getTipoLogradouro(),
            'nomeLogradouro' => $this->getNomeLogradouro(),
            'numeroLogradouro' => $this->getNumeroLogradouro(),
            'complemento' => $this->getComplemento(),
            'abreviatura' => $this->getAbreviatura(),
            'bairro' => $this->getBairro(),
            'numeroLocalidadeSuperior' => $this->getNumeroLocalidadeSuperior(),
            'localidadeSuperior' => $this->getLocalidadeSuperior(),
            'nome' => $this->getNome(),
            'siglaUnidade' => $this->getSiglaUnidade(),
            'tipoCEP' => $this->getTipoCEP(),
            'cepAnterior' => $this->getCepAnterior(),
            'distrito' => $this->getDistrito(),
            'cepUnidadeOperacional' => $this->getCepUnidadeOperacional(),
            'lado' => $this->getLado(),
            'numeroInicial' => $this->getNumeroInicial(),
            'numeroFinal' => $this->getNumeroFinal(),
            'clique' => $this->getClique(),
            'caixasPostais' => $this->getCaixasPostais()
                ? array_map(function (FaixaCaixaPostal $faixaCaixaPostal) {
                    return $faixaCaixaPostal->toArray();
                }, $this->getCaixasPostais())
                : null,
            'locker' => $this->getLocker(),
            'agenciaModular' => $this->getAgenciaModular(),
            'txMsg' => $this->getTxMsg(),
            'inSituacaoLocalidade' => $this->getInSituacaoLocalidade(),
            'dtFinalVigencia' => $this->getDtFinalVigencia(),
        ];
    }
}
