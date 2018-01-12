<?php
declare(strict_types=1);

namespace Midnight\Block\Renderer;

use Midnight\Block\BlockInterface;

interface RendererInterface
{
    public function render(BlockInterface $block): string;
}
