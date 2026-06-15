<?php

namespace ChicoRei\Packages\Correios\Tests\ModelTest;

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
}
