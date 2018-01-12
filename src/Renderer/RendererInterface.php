<?php
declare(strict_types=1);

namespace Midnight\Block\Renderer;

use Midnight\Block\BlockInterface;

/**
 * Interface RendererInterface
 *
 * @package Midnight\Block\Renderer
 */
interface RendererInterface
{
    /**
     * @param BlockInterface $block
     * @return string
     */
    public function render(BlockInterface $block);
}
