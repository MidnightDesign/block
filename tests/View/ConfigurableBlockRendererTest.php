<?php declare(strict_types=1);

namespace Midnight\test\Block\View;

use Midnight\Block\Type\ConfigurableType;
use Midnight\Block\Type\Field;
use Midnight\Block\View\ConfigurableBlockRenderer;
use Midnight\Block\View\SimpleTemplateRenderer;
use Midnight\Block\View\TemplateRendererInterface;
use PHPUnit\Framework\TestCase;

class ConfigurableBlockRendererTest extends TestCase
{
    /** @var TemplateRendererInterface */
    private $templateRenderer;
    /** @var ConfigurableBlockRenderer */
    private $renderer;

    protected function setUp()
    {
        parent::setUp();

        $this->templateRenderer = new SimpleTemplateRenderer();
        $this->renderer = new ConfigurableBlockRenderer($this->templateRenderer);
    }

    public function testRender()
    {
        $type = new ConfigurableType();
        $type->addField(Field::string('foo'));
        $template = 'Before {{foo}} After';
        $block = ConfigurableType::injectTemplate($type->create(['foo' => 'bar']), $template);

        $rendered = $this->renderer->render($block);

        $this->assertSame($this->templateRenderer->render($template, $block->serialize()), $rendered);
    }
}
