<?php

namespace ChicoRei\Packages\Correios\Tests\ModelTest;

use ChicoRei\Packages\Correios\Model\ClientePostagem;
use ChicoRei\Packages\Correios\Model\Destinatario;
use ChicoRei\Packages\Correios\Model\Remetente;
use PHPUnit\Framework\TestCase;

class RemetenteDestinatarioTest extends TestCase
{
    public function testRemetenteInheritsClientePostagem()
    {
        $remetente = Remetente::create(ClientePostagemTest::getTestData());

        $this->assertInstanceOf(ClientePostagem::class, $remetente);
        $this->assertSame(ClientePostagemTest::getTestData(), $remetente->toArray());
    }

    public function testDestinatarioInheritsClientePostagem()
    {
        $destinatario = Destinatario::create(ClientePostagemTest::getTestData());

        $this->assertInstanceOf(ClientePostagem::class, $destinatario);
        $this->assertSame(ClientePostagemTest::getTestData(), $destinatario->toArray());
    }

    public function testCreateReturnsCorrectConcreteType()
    {
        $this->assertInstanceOf(Remetente::class, Remetente::create());
        $this->assertInstanceOf(Destinatario::class, Destinatario::create());
    }
}
