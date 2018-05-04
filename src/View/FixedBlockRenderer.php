<?php declare(strict_types=1);

namespace Midnight\Block\View;

use Midnight\Block\Block;

final class FixedBlockRenderer implements BlockRendererInterface
{
    /** @var string */
    private $rendered;

    public function __construct(string $rendered)
    {
        $this->rendered = $rendered;
    }

    public function render(Block $block): string
    {
        return $this->rendered;
    }
}
