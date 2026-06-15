<?php

namespace ChicoRei\Packages\Correios\Tests\ModelTest;

use Carbon\Carbon;
use ChicoRei\Packages\Correios\Model\MalotePrePostagem;
use ChicoRei\Packages\Correios\Model\PrePostagem;
use ChicoRei\Packages\Correios\Model\PrePostagemHistoricoStatus;
use ChicoRei\Packages\Correios\Model\QueryPrePostagem;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class QueryPrePostagemTest extends TestCase
{
    private function makeQuery(): QueryPrePostagem
    {
        return QueryPrePostagem::create([
            'id' => 'abc-123',
            'codigoServico' => '03220',
            'statusAtual' => 3,
            'valorTotalBens' => 150.5,
            'codigoObjeto' => 'AA123456789BR',
            'historicoStatus' => [
                ['id' => 1, 'status' => 1, 'dataHora' => '2024-12-25T10:00:00-03:00'],
                ['id' => 2, 'status' => 3, 'dataHora' => '2024-12-26T11:00:00-03:00'],
            ],
            'malotePrePostagem' => ['numeroMalote' => '111'],
            'listaMalotes' => [
                ['numeroMalote' => '222'],
                ['numeroMalote' => '333'],
            ],
            'listaIdPrepostagemObjetos' => ['o1', 'o2'],
        ]);
    }

    public function testIsPrePostagem()
    {
        $this->assertInstanceOf(PrePostagem::class, QueryPrePostagem::create());
    }

    public function testHistoricoStatusIsConverted()
    {
        $query = $this->makeQuery();

        $this->assertContainsOnlyInstancesOf(
            PrePostagemHistoricoStatus::class,
            $query->getHistoricoStatus()
        );
        $this->assertCount(2, $query->getHistoricoStatus());
        $this->assertSame(3, $query->getHistoricoStatus()[1]->getStatus());
    }

    public function testMalotesAreConverted()
    {
        $query = $this->makeQuery();

        $this->assertInstanceOf(MalotePrePostagem::class, $query->getMalotePrePostagem());
        $this->assertSame('111', $query->getMalotePrePostagem()->getNumeroMalote());
        $this->assertContainsOnlyInstancesOf(MalotePrePostagem::class, $query->getListaMalotes());
        $this->assertSame('333', $query->getListaMalotes()[1]->getNumeroMalote());
    }

    public function testToArrayMergesParentAndOwnFields()
    {
        $array = $this->makeQuery()->toArray();

        // From parent PrePostagem
        $this->assertSame('03220', $array['codigoServico']);
        // From QueryPrePostagem
        $this->assertSame('abc-123', $array['id']);
        $this->assertSame(3, $array['statusAtual']);
        $this->assertSame(150.5, $array['valorTotalBens']);
        $this->assertSame(['o1', 'o2'], $array['listaIdPrepostagemObjetos']);
        $this->assertSame('111', $array['malotePrePostagem']['numeroMalote']);
        $this->assertCount(2, $array['historicoStatus']);
        $this->assertCount(2, $array['listaMalotes']);
    }

    public function testAddHistoricoStatusRejectsInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);
        QueryPrePostagem::create()->addHistoricoStatus('invalid');
    }

    public function testAddMaloteRejectsInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);
        QueryPrePostagem::create()->addMalote('invalid');
    }

    public function testSetCollectionsToNull()
    {
        $query = $this->makeQuery();
        $query->setHistoricoStatus(null);
        $query->setListaMalotes(null);

        $this->assertNull($query->getHistoricoStatus());
        $this->assertNull($query->getListaMalotes());
    }

    public function testAddHistoricoStatusInitializesListOnFreshObject()
    {
        $query = new QueryPrePostagem();
        $query->addHistoricoStatus(['id' => 1, 'status' => 1]);

        $this->assertContainsOnlyInstancesOf(
            PrePostagemHistoricoStatus::class,
            $query->getHistoricoStatus()
        );
        $this->assertSame(1, $query->getHistoricoStatus()[0]->getId());
    }

    public function testAddMaloteInitializesListOnFreshObject()
    {
        $query = new QueryPrePostagem();
        $query->addMalote(['numeroMalote' => '999']);

        $this->assertContainsOnlyInstancesOf(MalotePrePostagem::class, $query->getListaMalotes());
        $this->assertSame('999', $query->getListaMalotes()[0]->getNumeroMalote());
    }

    /**
     * All scalar/simple fields declared by QueryPrePostagem itself. Exercises
     * every own setter (via fill) and getter so none are left untested.
     */
    public static function getOwnScalarData(): array
    {
        return [
            'id' => 'q-1',
            'eticket' => 'ET-123',
            'dataEticket' => '2024-12-01T08:00:00-03:00',
            'embalagem' => 'Caixa P',
            'servico' => 'SEDEX',
            'statusAtual' => 3,
            'dataHoraStatusAtual' => '2024-12-02T09:00:00-03:00',
            'descStatusAtual' => 'POSTADO',
            'dataHora' => '2024-12-03T10:00:00-03:00',
            'tipoRotulo' => 'P',
            'retornoIntegracao' => 'OK',
            'sistemaOrigem' => 'SIGEP',
            'valorTotalBens' => 250.75,
            'listaIdPrepostagemObjetos' => ['a', 'b'],
            'quantidade' => 4,
            'reciboSolicitacaoAssincrona' => 'rec-1',
            'reciboSolicitacaoAssincronaRotulo' => 'rec-rot-1',
            'codigoFormatoObjetoPreAfericao' => '2',
            'alturaPreAfericao' => '11',
            'larguraPreAfericao' => '22',
            'comprimentoPreAfericao' => '33',
            'diametroPreAfericao' => '0',
            'pesoPreAfericao' => '305',
            'dataHoraPreAfericao' => '2024-12-04T11:00:00-03:00',
            'mcuUnidadePreAfericao' => 'mcu-1',
            'idBalancaCubagem' => 'bal-1',
            'cepDestinoPreAfericao' => '01310100',
            'ehObjetoDgr' => 'N',
            'tipoObjeto' => 'REGISTRADO',
            'erroAssincrono' => 'nenhum',
            'codigoEstampa2D' => 'EST-2D',
            'indicadorMalote' => 'N',
            'codigoGrafica' => 7,
            'codigoRemetente' => 'rem-1',
            'codigoDestinatario' => 'dest-1',
        ];
    }

    public function testAllOwnScalarSettersAndGetters()
    {
        $query = QueryPrePostagem::create(static::getOwnScalarData());

        $this->assertSame('q-1', $query->getId());
        $this->assertSame('ET-123', $query->getEticket());
        $this->assertSame('Caixa P', $query->getEmbalagem());
        $this->assertSame('SEDEX', $query->getServico());
        $this->assertSame(3, $query->getStatusAtual());
        $this->assertSame('POSTADO', $query->getDescStatusAtual());
        $this->assertSame('P', $query->getTipoRotulo());
        $this->assertSame('OK', $query->getRetornoIntegracao());
        $this->assertSame('SIGEP', $query->getSistemaOrigem());
        $this->assertSame(250.75, $query->getValorTotalBens());
        $this->assertSame(['a', 'b'], $query->getListaIdPrepostagemObjetos());
        $this->assertSame(4, $query->getQuantidade());
        $this->assertSame('rec-1', $query->getReciboSolicitacaoAssincrona());
        $this->assertSame('rec-rot-1', $query->getReciboSolicitacaoAssincronaRotulo());
        $this->assertSame('2', $query->getCodigoFormatoObjetoPreAfericao());
        $this->assertSame('11', $query->getAlturaPreAfericao());
        $this->assertSame('22', $query->getLarguraPreAfericao());
        $this->assertSame('33', $query->getComprimentoPreAfericao());
        $this->assertSame('0', $query->getDiametroPreAfericao());
        $this->assertSame('305', $query->getPesoPreAfericao());
        $this->assertSame('mcu-1', $query->getMcuUnidadePreAfericao());
        $this->assertSame('bal-1', $query->getIdBalancaCubagem());
        $this->assertSame('01310100', $query->getCepDestinoPreAfericao());
        $this->assertSame('N', $query->getEhObjetoDgr());
        $this->assertSame('REGISTRADO', $query->getTipoObjeto());
        $this->assertSame('nenhum', $query->getErroAssincrono());
        $this->assertSame('EST-2D', $query->getCodigoEstampa2D());
        $this->assertSame('N', $query->getIndicadorMalote());
        $this->assertSame(7, $query->getCodigoGrafica());
        $this->assertSame('rem-1', $query->getCodigoRemetente());
        $this->assertSame('dest-1', $query->getCodigoDestinatario());
    }

    public function testOwnDateSettersParseToCarbon()
    {
        $query = QueryPrePostagem::create(static::getOwnScalarData());

        $this->assertInstanceOf(Carbon::class, $query->getDataEticket());
        $this->assertInstanceOf(Carbon::class, $query->getDataHoraStatusAtual());
        $this->assertInstanceOf(Carbon::class, $query->getDataHora());
        $this->assertInstanceOf(Carbon::class, $query->getDataHoraPreAfericao());

        $array = $query->toArray();
        $this->assertSame($query->getDataEticket()->toIso8601String(), $array['dataEticket']);
        $this->assertSame($query->getDataHora()->toIso8601String(), $array['dataHora']);
        $this->assertSame($query->getDataHoraPreAfericao()->toIso8601String(), $array['dataHoraPreAfericao']);
    }
}
