<?php

namespace Midnight\Block\Renderer;

use InvalidArgumentException;
use Midnight\Block\BlockInterface;
use Midnight\Block\Dom\ClassSet;
use Midnight\Block\Image;

class ImageRenderer implements RendererInterface
{
    /**
     * @param Image|BlockInterface $block
     * @return string
     */
    public function render(BlockInterface $block)
    {
        if (!$block instanceof Image) {
            throw new InvalidArgumentException(sprintf('Expected %s, but got %s.', Image::class, get_class($block)));
        }
        return sprintf('<img src="%s"%s />', $block->getSrc(), ClassSet::toString($block->getClasses()));
    }
}
