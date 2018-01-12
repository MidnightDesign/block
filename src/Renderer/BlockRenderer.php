<?php

namespace Midnight\Block\Renderer;

use Midnight\Block\BlockInterface;
use Midnight\Block\Renderer\Exception\NoRendererFoundException;

class BlockRenderer implements RendererInterface
{
    /**
     * @var RendererInterface[]
     */
    private $renderers = [];

    /**
     * @param BlockInterface $block
     * @return string
     */
    public function render(BlockInterface $block): string
    {
        $renderer = $this->getRenderer($block);
        return $renderer->render($block);
    }

    /**
     * @param BlockInterface $block
     * @return RendererInterface
     */
    private function getRenderer(BlockInterface $block): RendererInterface
    {
        $blockClass = get_class($block);
        if (!isset($this->renderers[$blockClass])) {
            throw new NoRendererFoundException(sprintf('Could not find a renderer for "%s".', $blockClass));
        }
        return $this->renderers[$blockClass];
    }

    /**
     * @param string            $className
     * @param RendererInterface $renderer
     */
    public function setRenderer($className, RendererInterface $renderer)
    {
        $this->renderers[$className] = $renderer;
    }
}
