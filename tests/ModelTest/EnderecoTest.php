<?php

namespace ChicoRei\Packages\Correios\Tests\ModelTest;

use ChicoRei\Packages\Correios\Model\Endereco;
use PHPUnit\Framework\TestCase;

class EnderecoTest extends TestCase
{
    /**
     * Endereco Test Data
     * @return array
     */
    public static function getTestData()
    {
        return [
            'cep' => '01310-100',
            'logradouro' => 'Avenida Paulista',
            'numero' => '1578',
            'complemento' => 'Andar 5',
            'bairro' => 'Bela Vista',
            'cidade' => 'São Paulo',
            'uf' => 'SP',
            'regiao' => 'Sudeste',
            'pais' => 'BR',
        ];
    }

    public function testToArray()
    {
        $endereco = Endereco::create(static::getTestData());
        $this->assertSame(static::getTestData(), $endereco->toArray());
    }
}
