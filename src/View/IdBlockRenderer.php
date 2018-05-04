<?php declare(strict_types=1);

namespace Midnight\Block\View;

use Midnight\Block\Block;

final class IdBlockRenderer implements BlockRendererInterface
{
    public function render(Block $block): string
    {
        return $block->getId();
    }
}
