<?php

namespace MidnightTest\Block\Storage;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Midnight\Block\BlockInterface;
use Midnight\Block\Storage\Doctrine;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

class DoctrineTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Doctrine
     */
    private $storage;
    /**
     * @var BlockInterface
     */
    private $block;
    /**
     * @var ObjectManager|PHPUnit_Framework_MockObject_MockObject
     */
    private $objectManager;
    /**
     * @var ObjectRepository|PHPUnit_Framework_MockObject_MockObject
     */
    private $repository;

    public function setUp()
    {
        $this->repository = $this->getMock('Doctrine\Common\Persistence\ObjectRepository');

        $this->objectManager = $this->getMock('Doctrine\Common\Persistence\ObjectManager');
        $this->objectManager
            ->expects($this->any())
            ->method('getRepository')
            ->with('Midnight\Block\AbstractBlock')
            ->will($this->returnValue($this->repository));

        $this->storage = new Doctrine();
        $this->storage->setObjectManager($this->objectManager);

        $this->block = $this->getMock('Midnight\Block\BlockInterface');
    }

    public function testSave()
    {
        $block = $this->block;
        $objectManager = $this->objectManager;
        $objectManager->expects($this->once())->method('persist')->with($block);
        $objectManager->expects($this->once())->method('flush');
        $this->storage->save($block);
    }

    public function testLoad()
    {
        $id = 'foo';
        $this->repository
            ->expects($this->once())
            ->method('find')
            ->with($id)
            ->will($this->returnValue($this->block));
        $this->assertSame($this->block, $this->storage->load($id));
    }
}
