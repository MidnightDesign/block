<?php
declare(strict_types=1);

namespace Midnight\Block\Renderer;

use Midnight\Block\BlockInterface;
use Midnight\Block\Renderer\Exception\NoRendererFoundException;

class BlockRenderer implements RendererInterface
{
    /** @var RendererInterface[] */
    private $renderers = [];

    /**
     * @throws NoRendererFoundException
     */
    public function render(BlockInterface $block): string
    {
        return $this->getRenderer($block)->render($block);
    }

    /**
     * @throws NoRendererFoundException
     */
    private function getRenderer(BlockInterface $block): RendererInterface
    {
        $blockClass = \get_class($block);
        if (!isset($this->renderers[$blockClass])) {
            throw new NoRendererFoundException(sprintf('Could not find a renderer for "%s".', $blockClass));
        }
        return $this->renderers[$blockClass];
    }

    public function setRenderer(string $className, RendererInterface $renderer): void
    {
        $this->renderers[$className] = $renderer;
    }
}
