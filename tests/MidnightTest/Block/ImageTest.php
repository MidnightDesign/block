<?php

namespace MidnightTest\Block;

use Midnight\Block\Dom\ClassSetInterface;
use Midnight\Block\Image;
use PHPUnit\Framework\TestCase;

class ImageTest extends TestCase
{
    public function testGetSrc()
    {
        $src = 'foo.jpg';
        $image = new Image($src);
        $this->assertSame($src, $image->getSrc());
    }

    public function testNewInstanceHasEmptyClassSet()
    {
        $block = new Image('foo.jpg');

        $classSet = $block->getClasses();

        $this->assertInstanceOf(ClassSetInterface::class, $classSet);
        $this->assertCount(0, $classSet->getAll());
    }
}
