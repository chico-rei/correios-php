<?php

namespace ChicoRei\Packages\Correios\Tests\ModelTest;

use Carbon\Carbon;
use ChicoRei\Packages\Correios\Model\PrePostagemHistoricoStatus;
use PHPUnit\Framework\TestCase;

class PrePostagemHistoricoStatusTest extends TestCase
{
    public function testToArrayWithDate()
    {
        $status = PrePostagemHistoricoStatus::create([
            'id' => 10,
            'status' => 3,
            'dataHora' => '2024-12-25T10:30:00-03:00',
        ]);

        $array = $status->toArray();

        $this->assertSame(10, $array['id']);
        $this->assertSame(3, $array['status']);
        $this->assertInstanceOf(Carbon::class, $status->getDataHora());
        // Same instant as the input, regardless of timezone representation
        $this->assertTrue(Carbon::parse('2024-12-25T10:30:00-03:00')->equalTo($status->getDataHora()));
        $this->assertSame($status->getDataHora()->toIso8601String(), $array['dataHora']);
    }

    public function testToArrayWithNullDate()
    {
        $status = PrePostagemHistoricoStatus::create([
            'id' => 1,
            'status' => 1,
        ]);

        $this->assertSame([
            'id' => 1,
            'status' => 1,
            'dataHora' => null,
        ], $status->toArray());
    }

    public function testSetDataHoraAcceptsCarbonInstance()
    {
        $carbon = Carbon::parse('2023-01-01T00:00:00-03:00');
        $status = new PrePostagemHistoricoStatus();
        $status->setDataHora($carbon);

        $this->assertTrue($carbon->equalTo($status->getDataHora()));
    }
}
