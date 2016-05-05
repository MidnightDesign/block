<?php

namespace MidnightTest\Block;

use Midnight\Block\Html;
use PHPUnit_Framework_TestCase;

class HtmlTest extends PHPUnit_Framework_TestCase
{
    public function testCanSetAndGetHtml()
    {
        $block = new Html();
        $html = '<b>Foo!</b>';
        $block->setHtml($html);
        $this->assertEquals($html, $block->getHtml());
    }

    public function testNewInstanceHasId()
    {
        $block = new Html();
        $this->assertInternalType('string', $block->getId());
    }
}
