<?php
declare(strict_types=1);

namespace Midnight\Block;

class YouTube extends AbstractBlock
{
    /** @var string */
    private $videoId;

    public function __construct(string $videoId)
    {
        $this->videoId = $videoId;
    }

    public function getVideoId(): string
    {
        return $this->videoId;
    }
}
