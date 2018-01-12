<?php
declare(strict_types=1);

namespace MidnightTest\Block\Storage;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Midnight\Block\MutableBlock;
use Midnight\Block\BlockInterface;
use Midnight\Block\Storage\Doctrine;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class DoctrineTest extends TestCase
{
    /** @var Doctrine */
    private $storage;
    /** @var BlockInterface */
    private $block;
    /** @var ObjectManager|PHPUnit_Framework_MockObject_MockObject */
    private $objectManager;
    /** @var ObjectRepository|PHPUnit_Framework_MockObject_MockObject */
    private $repository;

    public function setUp()
    {
        $this->repository = $this->createMock(ObjectRepository::class);

        $this->objectManager = $this->createMock(ObjectManager::class);
        $this->objectManager
            ->expects($this->any())
            ->method('getRepository')
            ->with(MutableBlock::class)
            ->will($this->returnValue($this->repository));

        $this->storage = new Doctrine();
        $this->storage->setObjectManager($this->objectManager);

        $this->block = $this->createMock(BlockInterface::class);
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
