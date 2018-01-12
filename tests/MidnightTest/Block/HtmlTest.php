<?php
declare(strict_types=1);

namespace MidnightTest\Block;

use Midnight\Block\Html;
use PHPUnit\Framework\TestCase;

class HtmlTest extends TestCase
{
    public function testCanSetAndGetHtml()
    {
        $block = new Html();
        $html = '<b>Foo!</b>';
        $block->setHtml($html);
        $this->assertEquals($html, $block->getHtml());
    }

    public function testCanSetAndGetId()
    {
        $block = new Html();
        $id = 'myId';
        $block->setId($id);
        $this->assertEquals($id, $block->getId());
    }
}
