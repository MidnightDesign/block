<?php

namespace Midnight\Block;

class YouTube extends AbstractBlock
{
    /** @var string */
    private $videoId;

    /**
     * @param string $videoId
     */
    public function __construct($videoId)
    {
        $this->videoId = $videoId;
    }

    /**
     * @return string
     */
    public function getVideoId(): string
    {
        return $this->videoId;
    }
}
