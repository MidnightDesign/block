<?php
declare(strict_types=1);

namespace MidnightTest\Block;

use Midnight\Block\YouTube;
use PHPUnit\Framework\TestCase;

class YouTubeTest extends TestCase
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
