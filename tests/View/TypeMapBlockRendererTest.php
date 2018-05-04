<?php declare(strict_types=1);

namespace Midnight\Test\Block\View;

use Midnight\Block\Block;
use Midnight\Block\View\Exception\UnknownBlockTypeException;
use Midnight\Block\View\FixedBlockRenderer;
use Midnight\Block\View\TypeMapBlockRenderer;
use PHPUnit\Framework\TestCase;

class TypeMapBlockRendererTest extends TestCase
{
    /** @var TypeMapBlockRenderer */
    private $renderer;

    protected function setUp()
    {
        parent::setUp();

        $this->renderer = new TypeMapBlockRenderer([
            'foo' => new FixedBlockRenderer('My Rendered Foo'),
            'bar' => new FixedBlockRenderer('My Rendered Bar'),
        ]);
    }

    public function testTheCorrectRendererIsUsed()
    {
        $rendered = $this->renderer->render((new Block())->withType('bar'));

        $this->assertSame('My Rendered Bar', $rendered);
    }

    public function testThrowsAnExceptionIfTheTypeIsUnknown()
    {
        $block = (new Block())->withType('baz');

        $this->expectException(UnknownBlockTypeException::class);

        $this->renderer->render($block);
    }
}
