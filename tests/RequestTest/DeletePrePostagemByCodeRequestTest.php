<?php

namespace ChicoRei\Packages\Correios\Tests\RequestTest;

use ChicoRei\Packages\Correios\Request\DeletePrePostagemByCodeRequest;
use PHPUnit\Framework\TestCase;

class DeletePrePostagemByCodeRequestTest extends TestCase
{
    public static function getTestData(): array
    {
        return [
            'codigoObjeto' => 'AA123456789BR',
            'idCorreiosSolicitanteCancelamento' => 'idc-1',
        ];
    }

    public function testToArray()
    {
        $request = DeletePrePostagemByCodeRequest::create(static::getTestData());
        $this->assertSame(static::getTestData(), $request->toArray());
    }

    public function testRequestContract()
    {
        $request = DeletePrePostagemByCodeRequest::create(static::getTestData());

        $this->assertSame('DELETE', $request->getMethod());
        $this->assertSame('/prepostagem/v1/prepostagens/objeto/AA123456789BR', $request->getPath());
        $this->assertNull($request->getPayload());
        $this->assertSame(['idCorreiosSolicitanteCancelamento' => 'idc-1'], $request->getQuery());
    }

    public function testFluentSetters()
    {
        $request = new DeletePrePostagemByCodeRequest();

        $this->assertSame($request, $request->setCodigoObjeto('BB1'));
        $this->assertSame($request, $request->setIdCorreiosSolicitanteCancelamento('x'));
        $this->assertSame('BB1', $request->getCodigoObjeto());
        $this->assertSame('x', $request->getIdCorreiosSolicitanteCancelamento());
    }
}
