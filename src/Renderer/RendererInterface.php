<?php

namespace Midnight\Block\Renderer;

use Midnight\Block\BlockInterface;

interface RendererInterface
{
    /**
     * @param BlockInterface $block
     * @param array          $context
     *
     * @return string
     */
    public function render(BlockInterface $block, array $context);
} 