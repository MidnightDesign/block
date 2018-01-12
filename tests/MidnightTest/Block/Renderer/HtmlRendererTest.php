<?php

namespace MidnightTest\Block\Renderer;

use Midnight\Block\BlockInterface;
use Midnight\Block\Html;
use Midnight\Block\Renderer\HtmlRenderer;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class HtmlRendererTest extends TestCase
{
    /** @var HtmlRenderer */
    private $renderer;

    public function setUp()
    {
        $this->renderer = new HtmlRenderer();
    }

    public function testBasicRender()
    {
        $html = '<p>Test</p>';
        $block = $this->makeBlock();
        $block
            ->expects($this->any())
            ->method('getHtml')
            ->will($this->returnValue($html));

        $output = $this->renderer->render($block);

        $this->assertEquals($html, $output);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRenderThrowExceptionIfBlockIsOfTheWrongType()
    {
        /** @var BlockInterface|PHPUnit_Framework_MockObject_MockObject $block */
        $block = $this->getMockBuilder(BlockInterface::class)->getMock();
        $this->renderer->render($block);
    }

    /**
     * @return Html|PHPUnit_Framework_MockObject_MockObject
     */
    private function makeBlock()
    {
        return $this->getMockBuilder(Html::class)->getMock();
    }
}
