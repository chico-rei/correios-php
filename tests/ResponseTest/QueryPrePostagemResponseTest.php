<?php

namespace ChicoRei\Packages\Correios\Tests\ResponseTest;

use ChicoRei\Packages\Correios\Model\Pagination;
use ChicoRei\Packages\Correios\Model\QueryPrePostagem;
use ChicoRei\Packages\Correios\Response\QueryPrePostagemResponse;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class QueryPrePostagemResponseTest extends TestCase
{
    private function makeResponse(): QueryPrePostagemResponse
    {
        return QueryPrePostagemResponse::create([
            'itens' => [
                ['id' => 'a', 'codigoObjeto' => 'AA1'],
                ['id' => 'b', 'codigoObjeto' => 'BB2'],
            ],
            'page' => ['size' => 10, 'number' => 0, 'totalPages' => 1],
        ]);
    }

    public function testItensAreConverted()
    {
        $response = $this->makeResponse();

        $this->assertContainsOnlyInstancesOf(QueryPrePostagem::class, $response->getItens());
        $this->assertCount(2, $response->getItens());
        $this->assertSame('a', $response->getItens()[0]->getId());
    }

    public function testPageIsConverted()
    {
        $response = $this->makeResponse();

        $this->assertInstanceOf(Pagination::class, $response->getPage());
        $this->assertSame(10, $response->getPage()->getSize());
    }

    public function testToArray()
    {
        $array = $this->makeResponse()->toArray();

        $this->assertCount(2, $array['itens']);
        $this->assertSame('a', $array['itens'][0]['id']);
        $this->assertSame(10, $array['page']['size']);
    }

    public function testAddItemInitializesListOnFreshObject()
    {
        $response = new QueryPrePostagemResponse();
        $response->addItem(['id' => 'x']);

        $this->assertCount(1, $response->getItens());
        $this->assertInstanceOf(QueryPrePostagem::class, $response->getItens()[0]);
    }

    public function testAddItemAcceptsObject()
    {
        $response = new QueryPrePostagemResponse();
        $response->addItem(QueryPrePostagem::create(['id' => 'y']));

        $this->assertSame('y', $response->getItens()[0]->getId());
    }

    public function testAddItemRejectsInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);
        (new QueryPrePostagemResponse())->addItem('invalid');
    }

    public function testSetItensAndPageToNull()
    {
        $response = $this->makeResponse();
        $response->setItens(null);
        $response->setPage(null);

        $this->assertNull($response->getItens());
        $this->assertNull($response->getPage());
        $this->assertSame(['itens' => null, 'page' => null], $response->toArray());
    }
}
