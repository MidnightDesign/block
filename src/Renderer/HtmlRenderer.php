<?php
declare(strict_types=1);

namespace Midnight\Block\Renderer;

use InvalidArgumentException;
use Midnight\Block\BlockInterface;
use Midnight\Block\Html;

/**
 * Class HtmlRenderer
 *
 * @package Midnight\Block\Renderer
 */
class HtmlRenderer implements RendererInterface
{
    /**
     * @param Html|BlockInterface $block
     * @return string
     * @throws \InvalidArgumentException
     */
    public function render(BlockInterface $block): string
    {
        if (!$block instanceof Html) {
            throw new InvalidArgumentException(sprintf('Expected %s, but got %s.', Html::class, \get_class($block)));
        }
        return $block->getHtml();
    }
}
