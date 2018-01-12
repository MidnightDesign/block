<?php
declare(strict_types=1);

namespace Midnight\Block;

use Midnight\Block\Dom\ClassSet;
use Midnight\Block\Dom\ClassSetInterface;

class Image extends AbstractBlock
{
    /** @var string */
    private $src;
    /** @var ClassSetInterface */
    private $classes;

    public function __construct(string $src)
    {
        $this->src = $src;
        $this->classes = new ClassSet();
    }

    public function getSrc(): string
    {
        return $this->src;
    }

    public function getClasses(): ClassSetInterface
    {
        return $this->classes;
    }
}
