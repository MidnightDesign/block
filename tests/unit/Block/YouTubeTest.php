<?php

namespace MidnightTest\Block;

use Midnight\Block\YouTube;
use PHPUnit_Framework_TestCase;

class YouTubeTest extends PHPUnit_Framework_TestCase
{
    const DEFAULT_ID = 'foo';
    /** @var YouTube */
    private $block;

    public function setUp()
    {
        $this->block = new YouTube(self::DEFAULT_ID);
    }

    public function testGetId()
    {
        $this->assertEquals(self::DEFAULT_ID, $this->block->getVideoId());
    }
}
