<?php declare(strict_types=1);

namespace Midnight\Block\Type;

use Midnight\Block\Block;
use Midnight\Block\Exception\MissingPropertyException;
use Midnight\Block\View\BlockRendererInterface;

final class YouTubeType extends AbstractType implements BlockRendererInterface
{
    private const VIDEO_ID = 'video_id';
    private const TEMPLATE = '<iframe width="560" height="315" src="https://www.youtube.com/embed/%s" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>';
    private const TYPE = 'youtube_video';

    public function create(string $videoId): Block
    {
        return (new Block())
            ->withType(self::TYPE)
            ->withString(self::VIDEO_ID, $videoId);
    }

    /**
     * @throws MissingPropertyException
     */
    public function render(Block $block): string
    {
        return \sprintf(self::TEMPLATE, TypeUtil::forceGetString($block, self::VIDEO_ID));
    }
}
