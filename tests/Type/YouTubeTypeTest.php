<?php declare(strict_types=1);

namespace Midnight\Test\Block\Type;

use Midnight\Block\Block;
use Midnight\Block\Exception\MissingPropertyException;
use Midnight\Block\Type\YouTubeType;
use PHPUnit\Framework\TestCase;

class YouTubeTypeTest extends TestCase
{
    /** @var YouTubeType */
    private $type;

    protected function setUp()
    {
        parent::setUp();

        $this->type = new YouTubeType();
    }

    public function testRender()
    {
        $block = $this->type->create('dQw4w9WgXcQ');

        $rendered = $this->type->render($block);

        $expected = '<iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
        $this->assertSame($expected, $rendered);
    }

    public function testRenderThrowsExceptionIfIdIsMissing()
    {
        $block = new Block();

        $this->expectException(MissingPropertyException::class);

        $this->type->render($block);
    }
}
