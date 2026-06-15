<?php

namespace ChicoRei\Packages\Correios\Tests\ModelTest;

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
}
