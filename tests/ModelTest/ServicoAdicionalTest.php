<?php

namespace ChicoRei\Packages\Correios\Tests\ModelTest;

use ChicoRei\Packages\Correios\Model\ServicoAdicional;
use ChicoRei\Packages\Correios\Model\SubitemCheckList;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class ServicoAdicionalTest extends TestCase
{
    /**
     * ServicoAdicional Test Data
     * @return array
     */
    public static function getTestData()
    {
        return [
            'codigoServicoAdicional' => '019',
            'tipoServicoAdicional' => 'VD',
            'nomeServicoAdicional' => 'Valor Declarado',
            'valorServicoAdicional' => '1.50',
            'valorDeclarado' => '100.00',
            'siglaServicoAdicional' => 'VD',
            'orientacaoEntregaVizinho' => 'S',
            'tipoChecklist' => '05',
            'subitensCheckList' => [
                ['codigo' => '01'],
                ['codigo' => '02'],
            ],
        ];
    }

    public function testToArray()
    {
        $servico = ServicoAdicional::create(static::getTestData());
        $this->assertSame(static::getTestData(), $servico->toArray());
    }

    public function testSubitensAreConvertedToObjects()
    {
        $servico = ServicoAdicional::create(static::getTestData());
        $subitens = $servico->getSubitensCheckList();

        $this->assertCount(2, $subitens);
        $this->assertContainsOnlyInstancesOf(SubitemCheckList::class, $subitens);
        $this->assertSame('01', $subitens[0]->getCodigo());
    }

    public function testAddSubitemCheckListAcceptsObject()
    {
        $servico = new ServicoAdicional();
        $servico->addSubitemCheckList(SubitemCheckList::create(['codigo' => '07']));

        $this->assertCount(1, $servico->getSubitensCheckList());
        $this->assertSame('07', $servico->getSubitensCheckList()[0]->getCodigo());
    }

    public function testAddSubitemCheckListAcceptsArray()
    {
        $servico = new ServicoAdicional();
        $servico->addSubitemCheckList(['codigo' => '08']);

        $this->assertCount(1, $servico->getSubitensCheckList());
        $this->assertInstanceOf(SubitemCheckList::class, $servico->getSubitensCheckList()[0]);
    }

    public function testAddSubitemCheckListRejectsInvalidArgument()
    {
        $this->expectException(InvalidArgumentException::class);

        $servico = new ServicoAdicional();
        $servico->addSubitemCheckList('not-valid');
    }

    public function testSetSubitensToNullClearsList()
    {
        $servico = ServicoAdicional::create(static::getTestData());
        $servico->setSubitensCheckList(null);

        $this->assertNull($servico->getSubitensCheckList());
        $this->assertNull($servico->toArray()['subitensCheckList']);
    }
}
