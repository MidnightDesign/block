<?php

namespace Midnight\Block\Renderer;

use Midnight\Block\BlockInterface;
use Midnight\Block\Exception\InvalidArgumentException;

class Html implements RendererInterface
{
    public function render(BlockInterface $block, array $context)
    {
        if (!$block instanceof \Midnight\Block\Html) {
            throw new InvalidArgumentException(sprintf('%s expects a Midnight\Block\Html as the argument', __METHOD__));
        }
        return $block->getHtml();
    }
}