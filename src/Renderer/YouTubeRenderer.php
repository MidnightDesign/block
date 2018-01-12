<?php
declare(strict_types=1);

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
    public function render(BlockInterface $block): string
    {
        if (!$block instanceof YouTube) {
            throw new InvalidArgumentException(sprintf('Expected %s, but got %s.', YouTube::class, get_class($block)));
        }
        $template = '<iframe width="560" height="315" src="%s" frameborder="0" allowfullscreen></iframe>';
        return sprintf($template, $this->makeUrl($block));
    }

    /**
     * @param YouTube $block
     * @return string
     */
    private function makeUrl(YouTube $block): string
    {
        return sprintf('https://www.youtube.com/embed/%s', $block->getVideoId());
    }
}
