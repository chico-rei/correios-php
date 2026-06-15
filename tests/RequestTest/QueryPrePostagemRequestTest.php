<?php

namespace ChicoRei\Packages\Correios\Tests\RequestTest;

use Carbon\Carbon;
use ChicoRei\Packages\Correios\Request\QueryPrePostagemRequest;
use PHPUnit\Framework\TestCase;

class QueryPrePostagemRequestTest extends TestCase
{
    public static function getTestData(): array
    {
        return [
            'id' => 'q-1',
            'codigoObjeto' => 'AA123456789BR',
            'eTicket' => 'ET-1',
            'codigoEstampa2D' => 'EST-1',
            'idCorreios' => 'idc-1',
            'status' => 'POSTADO',
            'logisticaReversa' => 'N',
            'tipoObjeto' => 'TODOS',
            'modalidadePagamento' => 'A_VISTA',
            'objetoCargo' => 'N',
            'page' => '0',
            'size' => '50',
        ];
    }

    public function testToArrayWithScalarFields()
    {
        $request = QueryPrePostagemRequest::create(static::getTestData());

        $this->assertSame(array_merge(static::getTestData(), [
            'dataInicialCriacaoPrePostagem' => null,
            'dataFinalCriacaoPrePostagem' => null,
        ]), $this->reorderToArray($request->toArray()));
    }

    public function testDatesAreFormattedAsIsoDate()
    {
        $request = new QueryPrePostagemRequest();
        $request->setDataInicialCriacaoPrePostagem(Carbon::parse('2024-12-01'));
        $request->setDataFinalCriacaoPrePostagem(Carbon::parse('2024-12-31'));

        $array = $request->toArray();
        $this->assertSame('2024-12-01', $array['dataInicialCriacaoPrePostagem']);
        $this->assertSame('2024-12-31', $array['dataFinalCriacaoPrePostagem']);
    }

    public function testRequestContract()
    {
        $request = QueryPrePostagemRequest::create(['codigoObjeto' => 'AA123456789BR']);

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('/prepostagem/v2/prepostagens', $request->getPath());
        $this->assertNull($request->getPayload());
        $this->assertSame($request->toArray(), $request->getQuery());
    }

    public function testFluentSetters()
    {
        $request = new QueryPrePostagemRequest();

        $this->assertSame($request, $request->setId('1'));
        $this->assertSame($request, $request->setCodigoObjeto('AA1'));
        $this->assertSame($request, $request->setETicket('ET'));
        $this->assertSame($request, $request->setCodigoEstampa2D('E2D'));
        $this->assertSame($request, $request->setIdCorreios('idc'));
        $this->assertSame($request, $request->setStatus('POSTADO'));
        $this->assertSame($request, $request->setLogisticaReversa('N'));
        $this->assertSame($request, $request->setTipoObjeto('TODOS'));
        $this->assertSame($request, $request->setModalidadePagamento('A_VISTA'));
        $this->assertSame($request, $request->setObjetoCargo('N'));
        $this->assertSame($request, $request->setPage('0'));
        $this->assertSame($request, $request->setSize('50'));
        $this->assertSame($request, $request->setDataInicialCriacaoPrePostagem(null));
        $this->assertSame($request, $request->setDataFinalCriacaoPrePostagem(null));

        $this->assertSame('1', $request->getId());
        $this->assertSame('ET', $request->getETicket());
        $this->assertSame('E2D', $request->getCodigoEstampa2D());
        $this->assertSame('idc', $request->getIdCorreios());
        $this->assertSame('POSTADO', $request->getStatus());
        $this->assertSame('TODOS', $request->getTipoObjeto());
        $this->assertSame('A_VISTA', $request->getModalidadePagamento());
        $this->assertSame('N', $request->getObjetoCargo());
        $this->assertSame('0', $request->getPage());
        $this->assertSame('50', $request->getSize());
        $this->assertNull($request->getDataInicialCriacaoPrePostagem());
        $this->assertNull($request->getDataFinalCriacaoPrePostagem());
    }

    /**
     * Keep only the keys (in input order) plus the date keys so the assertion
     * does not depend on toArray()'s internal ordering.
     */
    private function reorderToArray(array $array): array
    {
        $ordered = [];
        foreach (static::getTestData() as $key => $value) {
            $ordered[$key] = $array[$key];
        }
        $ordered['dataInicialCriacaoPrePostagem'] = $array['dataInicialCriacaoPrePostagem'];
        $ordered['dataFinalCriacaoPrePostagem'] = $array['dataFinalCriacaoPrePostagem'];

        return $ordered;
    }
}
