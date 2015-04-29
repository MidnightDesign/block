<?php

namespace Midnight\Block;

class Image extends AbstractBlock
{
    /**
     * @var string
     */
    private $src;

    /**
     * @param string $src
     */
    public function __construct($src)
    {
        $this->src = $src;
    }

    /**
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }
}