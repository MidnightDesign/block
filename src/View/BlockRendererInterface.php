<?php declare(strict_types=1);

namespace Midnight\Block\View;

use Midnight\Block\Block;

interface BlockRendererInterface
{
    public function render(Block $block): string;
}
