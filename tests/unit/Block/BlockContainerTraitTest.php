<?php

namespace MidnightTest\Block;

use Midnight\Block\BlockContainerTrait;
use Midnight\Block\BlockInterface;
use MidnightTest\Block\Assets\BlockContainerImpl;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

class BlockContainerTraitTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var BlockContainerImpl
     */
    private $container;

    protected function setUp()
    {
        $this->container = $this->getObjectForTrait(BlockContainerTrait::class);
    }

    public function testAddToEmptyContainer()
    {
        $block = $this->makeBlock();

        $this->container->addBlock($block);
        $blocks = $this->container->getBlocks();

        $this->assertCount(1, $blocks);
        $this->assertSame($block, $blocks[0]);
    }

    public function testAddToEmptyContainerAtPosition()
    {
        $block = $this->makeBlock();

        $this->container->addBlock($block, 23);
        $blocks = $this->container->getBlocks();

        $this->assertCount(1, $blocks);
        $this->assertSame($block, $blocks[0]);
    }

    public function testAddAtOccupiedPosition()
    {
        $block1 = $this->makeBlock();
        $block2 = $this->makeBlock();
        $block3 = $this->makeBlock();
        $block4 = $this->makeBlock();
        $this->container->addBlock($block1);
        $this->container->addBlock($block2);
        $this->container->addBlock($block3);

        $this->container->addBlock($block4, 1);
        $blocks = $this->container->getBlocks();

        $this->assertCount(4, $blocks);
        $this->assertSame($block1, $blocks[0]);
        $this->assertSame($block4, $blocks[1]);
        $this->assertSame($block2, $blocks[2]);
        $this->assertSame($block3, $blocks[3]);
    }

    public function testAddAtNonExistingPosition()
    {
        $container = $this->container;
        $block1 = $this->makeBlock();
        $block2 = $this->makeBlock();

        $container->addBlock($block1, 42);
        $container->addBlock($block2, 23);
        $blocks = $container->getBlocks();

        $this->assertCount(2, $blocks);
        $this->assertSame($block1, $blocks[0]);
        $this->assertSame($block2, $blocks[1]);
    }

    public function testRemoveBlock()
    {
        $container = $this->container;
        $block = $this->makeBlock();
        $container->addBlock($block);

        $container->removeBlock($block);
        $blocks = $container->getBlocks();

        $this->assertCount(0, $blocks);
    }

    public function testRemoveBlockFromTheMiddle()
    {
        $container = $this->container;
        $block1 = $this->makeBlock();
        $block2 = $this->makeBlock();
        $block3 = $this->makeBlock();
        $block4 = $this->makeBlock();
        $container->addBlock($block1);
        $container->addBlock($block2);
        $container->addBlock($block3);
        $container->addBlock($block4);

        $container->removeBlock($block2);
        
        $blocks = $container->getBlocks();
        $this->assertCount(3, $blocks);
        $this->assertSame($block1, $blocks[0]);
        $this->assertSame($block3, $blocks[1]);
        $this->assertSame($block4, $blocks[2]);
    }

    public function testMoveDown()
    {
        $container = $this->container;
        $block1 = $this->makeBlock();
        $block2 = $this->makeBlock();
        $block3 = $this->makeBlock();
        $block4 = $this->makeBlock();
        $block5 = $this->makeBlock();
        $container->addBlock($block1);
        $container->addBlock($block2);
        $container->addBlock($block3);
        $container->addBlock($block4);
        $container->addBlock($block5);

        $container->moveBlock($block2, 3);
        $blocks = $container->getBlocks();

        $this->assertCount(5, $blocks);
        $this->assertSame($block1, $blocks[0]);
        $this->assertSame($block3, $blocks[1]);
        $this->assertSame($block4, $blocks[2]);
        $this->assertSame($block2, $blocks[3]);
        $this->assertSame($block5, $blocks[4]);
    }

    public function testMoveUp()
    {
        $container = $this->container;
        $block1 = $this->makeBlock();
        $block2 = $this->makeBlock();
        $block3 = $this->makeBlock();
        $block4 = $this->makeBlock();
        $block5 = $this->makeBlock();
        $container->addBlock($block1);
        $container->addBlock($block2);
        $container->addBlock($block3);
        $container->addBlock($block4);
        $container->addBlock($block5);

        $container->moveBlock($block4, 1);
        $blocks = $container->getBlocks();

        $this->assertCount(5, $blocks);
        $this->assertSame($block1, $blocks[0]);
        $this->assertSame($block4, $blocks[1]);
        $this->assertSame($block2, $blocks[2]);
        $this->assertSame($block3, $blocks[3]);
        $this->assertSame($block5, $blocks[4]);
    }

    public function testAddingAnExistingBlockWithNoPositionDoesNothing()
    {
        $container = $this->container;
        $block1 = $this->makeBlock();
        $block2 = $this->makeBlock();
        $block3 = $this->makeBlock();
        $container->addBlock($block1);
        $container->addBlock($block2);
        $container->addBlock($block3);

        $container->addBlock($block2);
        $blocks = $container->getBlocks();

        $this->assertCount(3, $blocks);
        $this->assertSame($block1, $blocks[0]);
        $this->assertSame($block2, $blocks[1]);
        $this->assertSame($block3, $blocks[2]);
    }

    public function testAddingAnExistingBlockWithPositionMovesIt()
    {
        $container = $this->container;
        $block1 = $this->makeBlock();
        $block2 = $this->makeBlock();
        $block3 = $this->makeBlock();
        $container->addBlock($block1);
        $container->addBlock($block2);
        $container->addBlock($block3);

        $container->addBlock($block3, 1);
        $blocks = $container->getBlocks();

        $this->assertCount(3, $blocks);
        $this->assertSame($block1, $blocks[0]);
        $this->assertSame($block3, $blocks[1]);
        $this->assertSame($block2, $blocks[2]);
    }

    public function testNewContainerIsEmpty()
    {
        $this->assertCount(0, $this->container->getBlocks());
    }

    /**
     * @return BlockInterface|PHPUnit_Framework_MockObject_MockObject
     */
    private function makeBlock()
    {
        return $this->getMockBuilder(BlockInterface::class)->getMock();
    }
}
