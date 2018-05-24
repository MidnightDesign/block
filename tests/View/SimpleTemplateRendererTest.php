<?php declare(strict_types=1);

namespace Midnight\Test\Block\View;

use Midnight\Block\View\SimpleTemplateRenderer;
use PHPUnit\Framework\TestCase;

class SimpleTemplateRendererTest extends TestCase
{
    /**
     * @dataProvider renderData
     */
    public function testRender(string $template, array $parameters, string $expected, string $keyPattern = null)
    {
        $renderer = new SimpleTemplateRenderer($keyPattern);

        $actual = $renderer->render($template, $parameters);

        $this->assertSame($expected, $actual);
    }

    public function renderData()
    {
        return [
            'simple' => ['Before {{foo}} After', ['foo' => 'Middle'], 'Before Middle After', '{{%s}}'],
            'default pattern' => ['Before {{foo}} After', ['foo' => 'Middle'], 'Before Middle After'],
        ];
    }
}
