<?php

namespace MidnightTest\Block\Renderer;

use InvalidArgumentException;
use Midnight\Block\BlockInterface;
use Midnight\Block\Image;
use Midnight\Block\Renderer\ImageRenderer;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;

class ImageRendererTest extends PHPUnit_Framework_TestCase
{
    /** @var ImageRenderer */
    private $renderer;

    public function setUp()
    {
        $this->renderer = new ImageRenderer();
    }

    public function testRenderBasicImage()
    {
        $block = $this->makeImageBlock('foo.jpg');

        $rendered = $this->renderer->render($block);

        $this->assertSame('<img src="foo.jpg" />', $rendered);
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
     * @param string $src
     * @return Image|PHPUnit_Framework_MockObject_MockObject
     */
    private function makeImageBlock($src)
    {
        $image = $this
            ->getMockBuilder(Image::class)
            ->disableOriginalConstructor()
            ->getMock();
        $image
            ->expects($this->any())
            ->method('getSrc')
            ->will($this->returnValue($src));
        return $image;
    }
}
