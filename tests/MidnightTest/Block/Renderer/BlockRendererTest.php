<?php
declare(strict_types=1);

namespace MidnightTest\Block\Renderer;

use Midnight\Block\BlockInterface;
use Midnight\Block\Renderer\BlockRenderer;
use Midnight\Block\Renderer\RendererInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class BlockRendererTest extends TestCase
{
    /** @var BlockRenderer */
    private $renderer;

    public function setUp()
    {
        $this->renderer = new BlockRenderer();
    }

    /**
     * @expectedException \Midnight\Block\Renderer\Exception\NoRendererFoundException
     */
    public function testExceptionIsThrownIfRendererIsNotFound()
    {
        $this->renderer->render($this->makeBlock());
    }

    public function testRenderUsesTheCorrectRenderer()
    {
        $block = $this->makeBlock();
        $renderer = $this->makeRenderer();
        $renderedBlock = 'Foo';
        $renderer
            ->expects($this->any())
            ->method('render')
            ->with($block)
            ->will($this->returnValue($renderedBlock));
        $this->renderer->setRenderer(get_class($block), $renderer);

        $output = $this->renderer->render($block);

        $this->assertEquals($renderedBlock, $output);
    }

    /**
     * @return BlockInterface|PHPUnit_Framework_MockObject_MockObject
     */
    private function makeBlock()
    {
        return $this->getMockBuilder(BlockInterface::class)->getMock();
    }

    /**
     * @return RendererInterface|PHPUnit_Framework_MockObject_MockObject
     */
    private function makeRenderer()
    {
        return $this->getMockBuilder(RendererInterface::class)->getMock();
    }
}
