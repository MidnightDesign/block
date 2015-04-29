<?php

namespace MidnightTest\Block;

use Midnight\Block\Image;
use PHPUnit_Framework_TestCase;

class ImageTest extends PHPUnit_Framework_TestCase
{
    public function testGetSrc()
    {
        $src = 'foo.jpg';
        $image = new Image($src);
        $this->assertSame($src, $image->getSrc());
    }
}
