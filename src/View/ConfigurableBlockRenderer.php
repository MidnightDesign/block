<?php declare(strict_types=1);

namespace Midnight\Block\View;

use Midnight\Block\Block;
use Midnight\Block\Type\ConfigurableType;

final class ConfigurableBlockRenderer implements BlockRendererInterface
{
    /** @var TemplateRendererInterface */
    private $templateRenderer;

    public function __construct(TemplateRendererInterface $templateRenderer)
    {
        $this->templateRenderer = $templateRenderer;
    }

    public function render(Block $block): string
    {
        return $this->templateRenderer->render(ConfigurableType::extractTemplate($block), $block->serialize());
    }
}
