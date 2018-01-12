<?php

namespace MidnightTest\Block\Renderer;

use InvalidArgumentException;
use Midnight\Block\BlockInterface;
use Midnight\Block\Renderer\YouTubeRenderer;
use Midnight\Block\YouTube;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class YouTubeRendererTest extends TestCase
{
    /** @var YouTubeRenderer */
    private $renderer;

    public function setUp()
    {
        $this->renderer = new YouTubeRenderer();
    }

    public function testSimpleRender()
    {
        $id = 'foo';
        $block = $this->makeBlock($id);

        $rendered = $this->renderer->render($block);

        $expectedUrl = 'https://www.youtube.com/embed/' . $id;
        $this->assertEquals(
            sprintf('<iframe width="560" height="315" src="%s" frameborder="0" allowfullscreen></iframe>',
                $expectedUrl),
            $rendered
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testRenderThrowsIfBlockIsNotTheRightClass()
    {
        /** @var BlockInterface $block */
        $block = $this->getMockBuilder(BlockInterface::class)->getMock();

        $this->renderer->render($block);
    }

    /**
     * @param string $videoId
     * @return YouTube|PHPUnit_Framework_MockObject_MockObject
     */
    private function makeBlock($videoId)
    {
        $block = $this
            ->getMockBuilder(YouTube::class)
            ->disableOriginalConstructor()
            ->getMock();
        $block
            ->expects($this->any())
            ->method('getVideoId')
            ->will($this->returnValue($videoId));
        return $block;
    }
}
