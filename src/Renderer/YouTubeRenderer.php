<?php

namespace Midnight\Block\Renderer;

use InvalidArgumentException;
use Midnight\Block\BlockInterface;
use Midnight\Block\YouTube;

class YouTubeRenderer implements RendererInterface
{
    /**
     * @param YouTube|BlockInterface $block
     * @return string
     */
    public function render(BlockInterface $block)
    {
        if (!$block instanceof YouTube) {
            throw new InvalidArgumentException(sprintf('Expected %, but got %s.', YouTube::class, get_class($block)));
        }
        $template = '<iframe width="560" height="315" src="%s" frameborder="0" allowfullscreen></iframe>';
        return sprintf($template, $this->makeUrl($block));
    }

    /**
     * @param YouTube $block
     * @return string
     */
    private function makeUrl(YouTube $block)
    {
        return sprintf('https://www.youtube.com/embed/%s', $block->getVideoId());
    }
}