<?php

namespace ChicoRei\Packages\Correios\Tests\ModelTest;

use ChicoRei\Packages\Correios\Model\ClientePostagem;
use ChicoRei\Packages\Correios\Model\Endereco;
use PHPUnit\Framework\TestCase;

class ClientePostagemTest extends TestCase
{
    /**
     * ClientePostagem Test Data
     * @return array
     */
    public static function getTestData()
    {
        return [
            'nome' => 'João da Silva',
            'codigo' => 'ABC123',
            'indicadorMalote' => 'N',
            'dddTelefone' => '11',
            'ddiTelefone' => '055',
            'telefone' => '33334444',
            'dddCelular' => '11',
            'ddiCelular' => '055',
            'celular' => '999998888',
            'email' => 'joao@example.com',
            'cpfCnpj' => '12345678909',
            'documentoEstrangeiro' => null,
            'obs' => 'Observação',
            'endereco' => EnderecoTest::getTestData(),
        ];
    }

    public function testToArray()
    {
        $cliente = ClientePostagem::create(static::getTestData());
        $this->assertSame(static::getTestData(), $cliente->toArray());
    }

    public function testEnderecoIsConvertedToObject()
    {
        $cliente = ClientePostagem::create(static::getTestData());
        $this->assertInstanceOf(Endereco::class, $cliente->getEndereco());
        $this->assertSame('São Paulo', $cliente->getEndereco()->getCidade());
    }

    public function testEnderecoAcceptsObjectInstance()
    {
        $endereco = Endereco::create(EnderecoTest::getTestData());
        $cliente = new ClientePostagem();
        $cliente->setEndereco($endereco);

        $this->assertSame($endereco, $cliente->getEndereco());
    }

    public function testEnderecoNullKeepsNull()
    {
        $cliente = new ClientePostagem();
        $cliente->setEndereco(null);

        $this->assertNull($cliente->getEndereco());
        $this->assertNull($cliente->toArray()['endereco']);
    }
}
