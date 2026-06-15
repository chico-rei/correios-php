<?php

namespace ChicoRei\Packages\Correios\Tests;

use ChicoRei\Packages\Correios\Model\Endereco;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * Tests the shared behaviour provided by the abstract CorreiosObject base
 * class, exercised through the concrete Endereco model.
 */
class CorreiosObjectTest extends TestCase
{
    public function testConstructorFillsKnownProperties()
    {
        $endereco = new Endereco(['cep' => '01310-100', 'uf' => 'SP']);

        $this->assertSame('01310-100', $endereco->getCep());
        $this->assertSame('SP', $endereco->getUf());
    }

    public function testFillIgnoresUnknownKeys()
    {
        $endereco = new Endereco(['cep' => '01310-100', 'naoExiste' => 'valor']);

        $this->assertSame('01310-100', $endereco->getCep());
        $this->assertArrayNotHasKey('naoExiste', $endereco->toArray());
    }

    public function testFillReturnsSelf()
    {
        $endereco = new Endereco();
        $this->assertSame($endereco, $endereco->fill(['cep' => '00000-000']));
    }

    public function testCreateWithArrayReturnsNewInstance()
    {
        $endereco = Endereco::create(['cidade' => 'São Paulo']);

        $this->assertInstanceOf(Endereco::class, $endereco);
        $this->assertSame('São Paulo', $endereco->getCidade());
    }

    public function testCreateIsIdempotentForInstances()
    {
        $endereco = Endereco::create(['cidade' => 'São Paulo']);

        $this->assertSame($endereco, Endereco::create($endereco));
    }

    public function testCreateWithEmptyArgumentReturnsEmptyInstance()
    {
        $endereco = Endereco::create();

        $this->assertInstanceOf(Endereco::class, $endereco);
        $this->assertNull($endereco->getCep());
    }

    public function testCreateWithNonArrayThrows()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('create() argument must be an array');

        Endereco::create('not-an-array');
    }
}
