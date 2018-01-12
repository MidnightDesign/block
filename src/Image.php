<?php

namespace Midnight\Block;

use Midnight\Block\Dom\ClassSet;
use Midnight\Block\Dom\ClassSetInterface;

class Image extends AbstractBlock
{
    /** @var string */
    private $src;
    /** @var ClassSetInterface */
    private $classes;

    /**
     * @param string $src
     */
    public function __construct($src)
    {
        $this->src = $src;
        $this->classes = new ClassSet();
    }

    /**
     * @return string
     */
    public function getSrc(): string
    {
        return $this->src;
    }

    /**
     * @return ClassSetInterface
     */
    public function getClasses(): ClassSetInterface
    {
        return $this->classes;
    }
}
