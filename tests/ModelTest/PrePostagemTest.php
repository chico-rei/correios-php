<?php

namespace ChicoRei\Packages\Correios\Tests\ModelTest;

use Carbon\Carbon;
use ChicoRei\Packages\Correios\Model\Destinatario;
use ChicoRei\Packages\Correios\Model\ItemDeclaracaoConteudo;
use ChicoRei\Packages\Correios\Model\Remetente;
use ChicoRei\Packages\Correios\Model\ServicoAdicional;
use ChicoRei\Packages\Correios\Request\CreatePrePostagemRequest;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * PrePostagem is abstract, so it is exercised through its concrete
 * subclass CreatePrePostagemRequest.
 */
class PrePostagemTest extends TestCase
{
    private function makePrePostagem(): CreatePrePostagemRequest
    {
        return CreatePrePostagemRequest::create([
            'codigoServico' => '03220',
            'remetente' => ClientePostagemTest::getTestData(),
            'destinatario' => ClientePostagemTest::getTestData(),
            'pesoInformado' => '300',
            'codigoFormatoObjetoInformado' => '2',
            'modalidadePagamento' => 1,
            'cienteObjetoNaoProibido' => 1,
            'listaServicoAdicional' => [
                ['codigoServicoAdicional' => '001'],
            ],
            'itensDeclaracaoConteudo' => [
                ['conteudo' => 'Livro', 'quantidade' => '1', 'valor' => '10.00'],
            ],
            'dataPrevistaPostagem' => '2024-12-25',
            'prazoPostagem' => '2025-01-10',
        ]);
    }

    public function testNestedClientsAreConverted()
    {
        $prePostagem = $this->makePrePostagem();

        $this->assertInstanceOf(Remetente::class, $prePostagem->getRemetente());
        $this->assertInstanceOf(Destinatario::class, $prePostagem->getDestinatario());
        $this->assertSame('João da Silva', $prePostagem->getRemetente()->getNome());
    }

    public function testNestedCollectionsAreConverted()
    {
        $prePostagem = $this->makePrePostagem();

        $this->assertContainsOnlyInstancesOf(
            ServicoAdicional::class,
            $prePostagem->getListaServicoAdicional()
        );
        $this->assertContainsOnlyInstancesOf(
            ItemDeclaracaoConteudo::class,
            $prePostagem->getItensDeclaracaoConteudo()
        );
    }

    public function testDatesAreFormattedAsBrazilianDate()
    {
        $array = $this->makePrePostagem()->toArray();

        $this->assertSame('25/12/2024', $array['dataPrevistaPostagem']);
        $this->assertSame('10/01/2025', $array['prazoPostagem']);
        $this->assertNull($array['dataValidadeLogReversa']);
    }

    public function testToArrayContainsConvertedNestedArrays()
    {
        $array = $this->makePrePostagem()->toArray();

        $this->assertSame('03220', $array['codigoServico']);
        $this->assertIsArray($array['remetente']);
        $this->assertSame('João da Silva', $array['remetente']['nome']);
        $this->assertSame('001', $array['listaServicoAdicional'][0]['codigoServicoAdicional']);
        $this->assertSame('Livro', $array['itensDeclaracaoConteudo'][0]['conteudo']);
    }

    public function testAddServicoAdicionalRejectsInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);
        CreatePrePostagemRequest::create()->addServicoAdicional('invalid');
    }

    public function testAddItemDeclaracaoConteudoRejectsInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);
        CreatePrePostagemRequest::create()->addItemDeclaracaoConteudo('invalid');
    }

    public function testRequestMetadata()
    {
        $request = $this->makePrePostagem();

        $this->assertSame('POST', $request->getMethod());
        $this->assertSame('/prepostagem/v1/prepostagens', $request->getPath());
        $this->assertNull($request->getQuery());
        $this->assertSame($request->toArray(), $request->getPayload());
    }

    /**
     * Every scalar field set on input. The keys differ from toArray() output:
     * dates are reformatted to d/m/Y and the nested object fields stay null.
     */
    public static function getScalarInputData(): array
    {
        return [
            'idCorreios' => 'idc-1',
            'codigoObjeto' => 'AA123456789BR',
            'codigoServico' => '03220',
            'modalidadePagamento' => 1,
            'precoServico' => 12.5,
            'precoPrePostagem' => 20.0,
            'numeroNotaFiscal' => '123456789012',
            'chaveNFe' => '12345678901234567890123456789012345678901234',
            'pesoInformado' => '300',
            'codigoFormatoObjetoInformado' => '2',
            'alturaInformada' => '10',
            'larguraInformada' => '20',
            'comprimentoInformado' => '30',
            'diametroInformado' => '0',
            'ncmObjeto' => '61091000',
            'rfidObjeto' => '12345678901234567890',
            'cienteObjetoNaoProibido' => 1,
            'idAtendimento' => 'atend-1',
            'solicitarColeta' => 'N',
            'dataPrevistaPostagem' => '2024-12-25',
            'observacao' => 'Frágil',
            'logisticaReversa' => 'N',
            'dataValidadeLogReversa' => '2025-01-05',
            'prazoPostagem' => '2025-01-10',
            'canalExternoOrigem' => 'WEB',
            'pedidoExternoOrigem' => 'pedido-1',
            'numeroCartaoPostagem' => '0067599079',
        ];
    }

    public function testToArrayWithAllScalarFields()
    {
        $prePostagem = CreatePrePostagemRequest::create(static::getScalarInputData());

        $this->assertSame([
            'idCorreios' => 'idc-1',
            'remetente' => null,
            'destinatario' => null,
            'codigoServico' => '03220',
            'precoServico' => 12.5,
            'precoPrePostagem' => 20.0,
            'numeroNotaFiscal' => '123456789012',
            'chaveNFe' => '12345678901234567890123456789012345678901234',
            'listaServicoAdicional' => null,
            'itensDeclaracaoConteudo' => null,
            'pesoInformado' => '300',
            'codigoFormatoObjetoInformado' => '2',
            'alturaInformada' => '10',
            'larguraInformada' => '20',
            'comprimentoInformado' => '30',
            'diametroInformado' => '0',
            'ncmObjeto' => '61091000',
            'rfidObjeto' => '12345678901234567890',
            'cienteObjetoNaoProibido' => 1,
            'idAtendimento' => 'atend-1',
            'solicitarColeta' => 'N',
            'codigoObjeto' => 'AA123456789BR',
            'dataPrevistaPostagem' => '25/12/2024',
            'observacao' => 'Frágil',
            'modalidadePagamento' => 1,
            'logisticaReversa' => 'N',
            'dataValidadeLogReversa' => '05/01/2025',
            'prazoPostagem' => '10/01/2025',
            'canalExternoOrigem' => 'WEB',
            'pedidoExternoOrigem' => 'pedido-1',
            'numeroCartaoPostagem' => '0067599079',
        ], $prePostagem->toArray());
    }

    public function testScalarGettersPreserveTypes()
    {
        $prePostagem = CreatePrePostagemRequest::create(static::getScalarInputData());

        $this->assertSame('idc-1', $prePostagem->getIdCorreios());
        $this->assertSame('AA123456789BR', $prePostagem->getCodigoObjeto());
        $this->assertSame('123456789012', $prePostagem->getNumeroNotaFiscal());
        $this->assertSame('12345678901234567890', $prePostagem->getRfidObjeto());
        $this->assertSame('61091000', $prePostagem->getNcmObjeto());
        $this->assertSame('atend-1', $prePostagem->getIdAtendimento());
        $this->assertSame('N', $prePostagem->getSolicitarColeta());
        $this->assertSame('Frágil', $prePostagem->getObservacao());
        $this->assertSame('N', $prePostagem->getLogisticaReversa());
        $this->assertSame('WEB', $prePostagem->getCanalExternoOrigem());
        $this->assertSame('pedido-1', $prePostagem->getPedidoExternoOrigem());
        $this->assertSame('0067599079', $prePostagem->getNumeroCartaoPostagem());

        $this->assertIsInt($prePostagem->getModalidadePagamento());
        $this->assertIsInt($prePostagem->getCienteObjetoNaoProibido());
        $this->assertIsFloat($prePostagem->getPrecoServico());
        $this->assertIsFloat($prePostagem->getPrecoPrePostagem());

        $this->assertInstanceOf(Carbon::class, $prePostagem->getDataPrevistaPostagem());
        $this->assertInstanceOf(Carbon::class, $prePostagem->getDataValidadeLogReversa());
        $this->assertInstanceOf(Carbon::class, $prePostagem->getPrazoPostagem());
    }

    public function testSettersAreFluent()
    {
        $prePostagem = new CreatePrePostagemRequest();

        $this->assertSame($prePostagem, $prePostagem->setIdCorreios('x'));
        $this->assertSame($prePostagem, $prePostagem->setPrecoServico(1.0));
        $this->assertSame($prePostagem, $prePostagem->setCienteObjetoNaoProibido(1));
        $this->assertSame($prePostagem, $prePostagem->setDataPrevistaPostagem('2024-12-25'));
    }

    public function testCollectionSettersAcceptNull()
    {
        $prePostagem = CreatePrePostagemRequest::create([
            'listaServicoAdicional' => [['codigoServicoAdicional' => '001']],
            'itensDeclaracaoConteudo' => [['conteudo' => 'X']],
        ]);

        $prePostagem->setListaServicoAdicional(null);
        $prePostagem->setItensDeclaracaoConteudo(null);

        $this->assertNull($prePostagem->getListaServicoAdicional());
        $this->assertNull($prePostagem->getItensDeclaracaoConteudo());
        $this->assertNull($prePostagem->toArray()['listaServicoAdicional']);
        $this->assertNull($prePostagem->toArray()['itensDeclaracaoConteudo']);
    }

    public function testNestedSettersAcceptNull()
    {
        $prePostagem = $this->makePrePostagem();

        $prePostagem->setRemetente(null);
        $prePostagem->setDestinatario(null);

        $this->assertNull($prePostagem->getRemetente());
        $this->assertNull($prePostagem->getDestinatario());
    }

    public function testDateGettersReturnNullWhenUnset()
    {
        $prePostagem = new CreatePrePostagemRequest();

        $this->assertNull($prePostagem->getDataPrevistaPostagem());
        $this->assertNull($prePostagem->getDataValidadeLogReversa());
        $this->assertNull($prePostagem->getPrazoPostagem());
    }

    public function testAddServicoAdicionalInitializesListOnFreshObject()
    {
        $prePostagem = new CreatePrePostagemRequest();
        $prePostagem->addServicoAdicional(['codigoServicoAdicional' => '019']);

        $this->assertContainsOnlyInstancesOf(
            ServicoAdicional::class,
            $prePostagem->getListaServicoAdicional()
        );
        $this->assertSame('019', $prePostagem->getListaServicoAdicional()[0]->getCodigoServicoAdicional());
    }

    public function testAddItemDeclaracaoConteudoInitializesListOnFreshObject()
    {
        $prePostagem = new CreatePrePostagemRequest();
        $prePostagem->addItemDeclaracaoConteudo(['conteudo' => 'Livro']);

        $this->assertContainsOnlyInstancesOf(
            ItemDeclaracaoConteudo::class,
            $prePostagem->getItensDeclaracaoConteudo()
        );
        $this->assertSame('Livro', $prePostagem->getItensDeclaracaoConteudo()[0]->getConteudo());
    }
}
