<?php

namespace ChicoRei\Packages\Correios\Tests\ResponseTest;

use Carbon\Carbon;
use ChicoRei\Packages\Correios\Model\ServicoAdicional;
use ChicoRei\Packages\Correios\Response\GetPrePostagemPostadaResponse;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class GetPrePostagemPostadaResponseTest extends TestCase
{
    public static function getTestData(): array
    {
        return [
            'id' => 'posted-1',
            'numeroExternoCliente' => 'ext-1',
            'numeroCartaoPostagem' => '0067599079',
            'cepAgencia' => '01000000',
            'cepDestino' => '20000000',
            'numeroAtendimento' => 'at-1',
            'dataPostagem' => '2024-12-25T10:30:00-03:00',
            'valorAtendimento' => 35.9,
            'numeroSistema' => 'sis-1',
            'cepRemetente' => '01001000',
            'cepDestinatario' => '20020000',
            'codigoObjeto' => 'AA123456789BR',
            'codigoServico' => '03220',
            'nomeServico' => 'SEDEX',
            'alturaObjeto' => '10',
            'comprimentoObjeto' => '30',
            'larguraObjeto' => '20',
            'diametroObjeto' => '0',
            'pesoObjeto' => '300',
            'pesoTarifadoObjeto' => '350',
            'valorDeclaradoObjeto' => '100.00',
            'listaServicoAdicional' => [
                ['codigoServicoAdicional' => '001'],
            ],
        ];
    }

    public function testScalarGettersRoundTrip()
    {
        $response = GetPrePostagemPostadaResponse::create(static::getTestData());

        $this->assertSame('posted-1', $response->getId());
        $this->assertSame('ext-1', $response->getNumeroExternoCliente());
        $this->assertSame('0067599079', $response->getNumeroCartaoPostagem());
        $this->assertSame('01000000', $response->getCepAgencia());
        $this->assertSame('20000000', $response->getCepDestino());
        $this->assertSame('at-1', $response->getNumeroAtendimento());
        $this->assertIsFloat($response->getValorAtendimento());
        $this->assertSame('sis-1', $response->getNumeroSistema());
        $this->assertSame('01001000', $response->getCepRemetente());
        $this->assertSame('20020000', $response->getCepDestinatario());
        $this->assertSame('AA123456789BR', $response->getCodigoObjeto());
        $this->assertSame('03220', $response->getCodigoServico());
        $this->assertSame('SEDEX', $response->getNomeServico());
        $this->assertSame('10', $response->getAlturaObjeto());
        $this->assertSame('30', $response->getComprimentoObjeto());
        $this->assertSame('20', $response->getLarguraObjeto());
        $this->assertSame('0', $response->getDiametroObjeto());
        $this->assertSame('300', $response->getPesoObjeto());
        $this->assertSame('350', $response->getPesoTarifadoObjeto());
        $this->assertSame('100.00', $response->getValorDeclaradoObjeto());
    }

    public function testDataPostagemParsedToCarbon()
    {
        $response = GetPrePostagemPostadaResponse::create(static::getTestData());

        $this->assertInstanceOf(Carbon::class, $response->getDataPostagem());
        $this->assertSame(
            $response->getDataPostagem()->toIso8601String(),
            $response->toArray()['dataPostagem']
        );
    }

    public function testToArrayStructure()
    {
        $array = GetPrePostagemPostadaResponse::create(static::getTestData())->toArray();

        $this->assertSame('posted-1', $array['id']);
        $this->assertSame(35.9, $array['valorAtendimento']);
        $this->assertSame('001', $array['listaServicoAdicional'][0]['codigoServicoAdicional']);
    }

    public function testListaServicoAdicionalConverted()
    {
        $response = GetPrePostagemPostadaResponse::create(static::getTestData());

        $this->assertContainsOnlyInstancesOf(
            ServicoAdicional::class,
            $response->getListaServicoAdicional()
        );
    }

    public function testAddServicoAdicionalInitializesListOnFreshObject()
    {
        $response = new GetPrePostagemPostadaResponse();
        $response->addServicoAdicional(['codigoServicoAdicional' => '019']);

        $this->assertCount(1, $response->getListaServicoAdicional());
        $this->assertInstanceOf(ServicoAdicional::class, $response->getListaServicoAdicional()[0]);
    }

    public function testAddServicoAdicionalRejectsInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);
        (new GetPrePostagemPostadaResponse())->addServicoAdicional('invalid');
    }

    public function testSetListaServicoAdicionalToNull()
    {
        $response = GetPrePostagemPostadaResponse::create(static::getTestData());
        $response->setListaServicoAdicional(null);

        $this->assertNull($response->getListaServicoAdicional());
        $this->assertNull($response->toArray()['listaServicoAdicional']);
    }

    public function testDataPostagemNullWhenUnset()
    {
        $response = new GetPrePostagemPostadaResponse();
        $this->assertNull($response->getDataPostagem());
        $this->assertNull($response->toArray()['dataPostagem']);
    }
}
