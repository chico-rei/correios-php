<?php

namespace ChicoRei\Packages\Correios\Tests\ResponseTest;

use ChicoRei\Packages\Correios\Model\FaixaCaixaPostal;
use ChicoRei\Packages\Correios\Response\CepResponse;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class CepResponseTest extends TestCase
{
    /**
     * Every field, in toArray() order, so the round-trip can use assertSame.
     */
    public static function getTestData(): array
    {
        return [
            'cep' => '70002900',
            'uf' => 'DF',
            'numeroLocalidade' => 1,
            'localidade' => 'Brasília',
            'logradouro' => 'SBN Quadra 1',
            'tipoLogradouro' => 'Quadra',
            'nomeLogradouro' => 'SBN Quadra 1',
            'numeroLogradouro' => '100',
            'complemento' => 'Bloco A',
            'abreviatura' => 'Qd',
            'bairro' => 'Asa Norte',
            'numeroLocalidadeSuperior' => 2,
            'localidadeSuperior' => 'Distrito Federal',
            'nome' => 'Edifício Sede',
            'siglaUnidade' => 'BSB',
            'tipoCEP' => 5,
            'cepAnterior' => '70002899',
            'distrito' => 'Plano Piloto',
            'cepUnidadeOperacional' => '70002901',
            'lado' => 'P',
            'numeroInicial' => 1,
            'numeroFinal' => 999,
            'clique' => 'N',
            'caixasPostais' => [
                ['nuInicial' => 1, 'nuFinal' => 50],
                ['nuInicial' => 51, 'nuFinal' => 100],
            ],
            'locker' => 'N',
            'agenciaModular' => 'N',
            'txMsg' => 'Sucesso',
            'inSituacaoLocalidade' => '0',
            'dtFinalVigencia' => '2030-12-31',
        ];
    }

    public function testToArray()
    {
        $response = CepResponse::create(static::getTestData());
        $this->assertSame(static::getTestData(), $response->toArray());
    }

    public function testScalarGettersPreserveTypes()
    {
        $response = CepResponse::create(static::getTestData());

        $this->assertSame('70002900', $response->getCep());
        $this->assertSame('DF', $response->getUf());
        $this->assertIsInt($response->getNumeroLocalidade());
        $this->assertIsInt($response->getNumeroLocalidadeSuperior());
        $this->assertIsInt($response->getTipoCEP());
        $this->assertIsInt($response->getNumeroInicial());
        $this->assertIsInt($response->getNumeroFinal());
        $this->assertSame('Sucesso', $response->getTxMsg());
        $this->assertSame('2030-12-31', $response->getDtFinalVigencia());
    }

    public function testCaixasPostaisAreConverted()
    {
        $response = CepResponse::create(static::getTestData());

        $this->assertContainsOnlyInstancesOf(FaixaCaixaPostal::class, $response->getCaixasPostais());
        $this->assertSame(1, $response->getCaixasPostais()[0]->getNuInicial());
        $this->assertSame(100, $response->getCaixasPostais()[1]->getNuFinal());
    }

    public function testAddCaixaPostalInitializesListOnFreshObject()
    {
        $response = new CepResponse();
        $response->addCaixaPostal(['nuInicial' => 1, 'nuFinal' => 10]);

        $this->assertCount(1, $response->getCaixasPostais());
        $this->assertInstanceOf(FaixaCaixaPostal::class, $response->getCaixasPostais()[0]);
    }

    public function testAddCaixaPostalAcceptsObject()
    {
        $response = new CepResponse();
        $response->addCaixaPostal(FaixaCaixaPostal::create(['nuInicial' => 2, 'nuFinal' => 20]));

        $this->assertSame(2, $response->getCaixasPostais()[0]->getNuInicial());
    }

    public function testAddCaixaPostalRejectsInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);
        (new CepResponse())->addCaixaPostal('invalid');
    }

    public function testSetCaixasPostaisToNullClearsList()
    {
        $response = CepResponse::create(static::getTestData());
        $response->setCaixasPostais(null);

        $this->assertNull($response->getCaixasPostais());
        $this->assertNull($response->toArray()['caixasPostais']);
    }
}
