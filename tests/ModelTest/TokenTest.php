<?php

namespace ChicoRei\Packages\Correios\Tests\ModelTest;

use Carbon\Carbon;
use ChicoRei\Packages\Correios\Model\Token;
use PHPUnit\Framework\TestCase;

class TokenTest extends TestCase
{
    /**
     * Token Test Data (non-date fields)
     * @return array
     */
    public static function getTestData()
    {
        return [
            'ambiente' => 'PRODUCAO',
            'id' => 'user-id',
            'ip' => '127.0.0.1',
            'perfil' => 'PJ',
            'cnpj' => '12345678000199',
            'pjInternacional' => 42,
            'cpf' => null,
            'categoria' => 'CONTRATO_TODOS',
            'chv' => 99,
            'cie' => 'cie-value',
            'zoneOffset' => '-03:00',
            'paths' => ['/path/a', '/path/b'],
            'token' => 'jwt.token.value',
        ];
    }

    public function testToArrayScalarFields()
    {
        $token = Token::create(static::getTestData());
        $array = $token->toArray();

        foreach (static::getTestData() as $key => $value) {
            $this->assertSame($value, $array[$key], "Field {$key} did not round-trip");
        }

        // Date fields default to null when not provided
        $this->assertNull($array['emissao']);
        $this->assertNull($array['expiraEm']);
    }

    public function testDatesAreParsedAndSerialized()
    {
        $token = Token::create([
            'emissao' => '2024-01-01T08:00:00-03:00',
            'expiraEm' => '2024-01-02T08:00:00-03:00',
        ]);

        $this->assertInstanceOf(Carbon::class, $token->getEmissao());
        $this->assertInstanceOf(Carbon::class, $token->getExpiraEm());
        $this->assertTrue(Carbon::parse('2024-01-01T08:00:00-03:00')->equalTo($token->getEmissao()));
        $this->assertSame($token->getEmissao()->toIso8601String(), $token->toArray()['emissao']);
        $this->assertSame($token->getExpiraEm()->toIso8601String(), $token->toArray()['expiraEm']);
    }

    public function testIntegerTypesPreserved()
    {
        $token = Token::create(static::getTestData());
        $this->assertIsInt($token->getPjInternacional());
        $this->assertIsInt($token->getChv());
    }
}
