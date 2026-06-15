<?php

namespace ChicoRei\Packages\Correios\Tests\ResponseTest;

use ChicoRei\Packages\Correios\Response\DeletePrePostagemByCodeResponse;
use PHPUnit\Framework\TestCase;

class DeletePrePostagemByCodeResponseTest extends TestCase
{
    public static function getTestData(): array
    {
        return [
            'resultadoCancelamento' => 'OK',
            'mensagem' => 'Cancelado com sucesso',
            'idRecibo' => 'rec-1',
        ];
    }

    public function testToArray()
    {
        $response = DeletePrePostagemByCodeResponse::create(static::getTestData());
        $this->assertSame(static::getTestData(), $response->toArray());
    }

    public function testFluentSetters()
    {
        $response = new DeletePrePostagemByCodeResponse();

        $this->assertSame($response, $response->setResultadoCancelamento('OK'));
        $this->assertSame($response, $response->setMensagem('m'));
        $this->assertSame($response, $response->setIdRecibo('r'));

        $this->assertSame('OK', $response->getResultadoCancelamento());
        $this->assertSame('m', $response->getMensagem());
        $this->assertSame('r', $response->getIdRecibo());
    }
}
