<?php
declare(strict_types=1);

namespace MidnightTest\Block;

use Midnight\Block\BlockInterface;
use Midnight\Block\BlockList;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

class BlockListTest extends TestCase
{
    public function testNewInstanceIsEmpty()
    {
        $list = new BlockList();
        $this->assertEmpty($list->getAll());
    }

    public function testAdd()
    {
        $list = new BlockList();
        $list->add($this->getMockBlock());
        $this->assertEquals(1, count($list->getAll()));
    }

    public function testAddAtOccupiedPosition()
    {
        $blockOne = $this->getMockBlock();
        $blockTwo = $this->getMockBlock();
        $blockThree = $this->getMockBlock();

        $list = new BlockList();

        $list->add($blockOne);
        $list->add($blockTwo);
        $list->add($blockThree, 1);

        $blocks = $list->getAll();
        $this->assertSame($blockOne, $blocks[0]);
        $this->assertSame($blockThree, $blocks[1]);
        $this->assertSame($blockTwo, $blocks[2]);
    }

    public function testSetPosition()
    {
        $list = new BlockList();
        $blocks = [];
        for ($i = 0; $i < 10; $i++) {
            $block = $this->getMockBlock();
            $blocks[] = $block;
            $list->add($block);
        }
        $list->setPosition($blocks[7], 3);
        $listBlocks = $list->getAll();
        $this->assertSame($blocks[0], $listBlocks[0]);
        $this->assertSame($blocks[1], $listBlocks[1]);
        $this->assertSame($blocks[2], $listBlocks[2]);
        $this->assertSame($blocks[3], $listBlocks[4]);
        $this->assertSame($blocks[4], $listBlocks[5]);
        $this->assertSame($blocks[5], $listBlocks[6]);
        $this->assertSame($blocks[6], $listBlocks[7]);
        $this->assertSame($blocks[7], $listBlocks[3]);
        $this->assertSame($blocks[8], $listBlocks[8]);
        $this->assertSame($blocks[9], $listBlocks[9]);
    }

    /**
     * @throws \Midnight\Block\Exception\BlockNotFoundException
     * @expectedException \Midnight\Block\Exception\BlockNotFoundException
     */
    public function testMovingAnUnknownBlockThrowsAnException()
    {
        $list = new BlockList();
        $blockOne = $this->getMockBlock();
        $blockTwo = $this->getMockBlock();
        $list->add($blockOne);
        $list->setPosition($blockTwo, 0);
    }

    public function testRemove()
    {
        $list = new BlockList();
        $block = $this->getMockBlock();
        $list->add($block);
        $list->remove($block);
        $this->assertEquals(0, count($list->getAll()));
    }

    /**
     * @return BlockInterface|PHPUnit_Framework_MockObject_MockObject
     */
    private function getMockBlock()
    {
        return $this->createMock(BlockInterface::class);
    }
}
