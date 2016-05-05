<?php

namespace MidnightTest\Block\Dom;

use Midnight\Block\Dom\ClassSet;

class ClassSetTest extends \PHPUnit_Framework_TestCase
{
    /** @var ClassSet */
    private $set;

    public function setUp()
    {
        $this->set = new ClassSet();
    }

    public function testNewSetIsEmpty()
    {
        $this->assertCount(0, $this->set->getAll());
    }

    public function testSimpleAdd()
    {
        $class = 'foo';
        $this->set->add($class);

        $this->assertSingleClass($class);
    }

    public function testClassIsTrimmedBeforeItGetsCompared()
    {
        $this->set->add('foo');
        $this->set->add('foo ');

        $this->assertSingleClass('foo');
    }

    public function testAddingTheSameClassASecondTimeDoesNotDoAnything()
    {
        $class = 'foo';
        $this->set->add($class);
        $this->set->add($class);

        $this->assertSingleClass($class);
    }

    public function testAddingMultipleClasses()
    {
        $this->set->add('foo');
        $this->set->add('bar');

        $classes = $this->set->getAll();

        $this->assertCount(2, $classes);
        $this->assertContains('foo', $classes);
        $this->assertContains('bar', $classes);
    }

    public function testRemovingAnExistingClass()
    {
        $this->set->add('foo');

        $this->set->remove('foo');

        $this->assertCount(0, $this->set->getAll());
    }

    public function testAddingAnEmptyClassDoesNotDoAnything()
    {
        $this->set->add('');

        $this->assertCount(0, $this->set->getAll());
    }

    public function testRemovingANonExistentClass()
    {
        $this->set->add('foo');
        $this->set->remove('bar');

        $this->assertSingleClass('foo');
    }

    /**
     * @param string $class
     */
    private function assertSingleClass($class)
    {
        $classes = $this->set->getAll();
        $this->assertCount(1, $classes);
        $this->assertEquals($class, $classes[0]);
    }
}
