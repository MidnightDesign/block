<?php
declare(strict_types=1);

namespace MidnightTest\Block\Renderer;

use InvalidArgumentException;
use Midnight\Block\BlockInterface;
use Midnight\Block\Dom\ClassSet;
use Midnight\Block\Image;
use Midnight\Block\Renderer\ImageRenderer;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class ImageRendererTest extends TestCase
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

    public function testRenderImageWithClasses()
    {
        $block = $this->makeImageBlock('foo.jpg');
        $classes = $block->getClasses();
        $classes->add('foo');
        $classes->add('bar');

        $rendered = $this->renderer->render($block);

        $this->assertSame('<img src="foo.jpg" class="foo bar" />', $rendered);
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
        $image
            ->expects($this->any())
            ->method('getClasses')
            ->will($this->returnValue(new ClassSet()));
        return $image;
    }
}
