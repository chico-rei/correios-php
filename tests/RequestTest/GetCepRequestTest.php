<?php

namespace ChicoRei\Packages\Correios\Tests\RequestTest;

use ChicoRei\Packages\Correios\Request\GetCepRequest;
use PHPUnit\Framework\TestCase;

class GetCepRequestTest extends TestCase
{
    public function testToArray()
    {
        $request = GetCepRequest::create(['cep' => '01310100']);
        $this->assertSame(['cep' => '01310100'], $request->toArray());
    }

    public function testRequestContract()
    {
        $request = GetCepRequest::create(['cep' => '01310100']);

        $this->assertSame('GET', $request->getMethod());
        $this->assertSame('/cep/v2/enderecos/01310100', $request->getPath());
        $this->assertNull($request->getPayload());
        $this->assertNull($request->getQuery());
    }

    public function testFluentSetter()
    {
        $request = new GetCepRequest();
        $this->assertSame($request, $request->setCep('20010000'));
        $this->assertSame('20010000', $request->getCep());
    }
}
