<?php declare(strict_types=1);

namespace Midnight\Test\Block;

use Midnight\Block\Block;
use PHPUnit\Framework\TestCase;

class BlockTest extends TestCase
{
    public function testDeserialize()
    {
        $block = Block::deserialize(['foo' => 'bar']);

        $this->assertSame('bar', $block->getString('foo'));
    }
}
