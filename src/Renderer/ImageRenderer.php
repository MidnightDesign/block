<?php

namespace Midnight\Block\Renderer;

use InvalidArgumentException;
use Midnight\Block\BlockInterface;
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
            throw new InvalidArgumentException(sprintf('Expected %, but got %s.', Image::class, get_class($block)));
        }
        return sprintf('<img src="%s" />', $block->getSrc());
    }
}