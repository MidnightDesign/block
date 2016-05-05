<?php

namespace MidnightTest\Block\Storage;

use Midnight\Block\AbstractBlock;
use Midnight\Block\BlockInterface;
use Midnight\Block\Exception\BlockNotFoundException;
use Midnight\Block\Storage\Filesystem;
use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use PHPUnit_Framework_MockObject_MockObject;
use PHPUnit_Framework_TestCase;
use RuntimeException;

class FilesystemTest extends PHPUnit_Framework_TestCase
{
    /** @var Filesystem */
    private $storage;
    /** @var BlockInterface|PHPUnit_Framework_MockObject_MockObject */
    private $block;
    /** @var vfsStreamDirectory */
    private $fs;

    public function setUp()
    {
        $this->fs = vfsStream::setup('test');
        $this->storage = new Filesystem($this->fs->url());
        $this->block = $this->getMockForAbstractClass(AbstractBlock::class);
    }

    public function testSave()
    {
        $this->storage->save($this->block);

        $this->assertTrue($this->fs->hasChild($this->block->getId()));
    }

    public function testDirectoryIsCreatedIfItDoesNotExist()
    {
        $dir = 'sub';
        $this->storage = new Filesystem($this->fs->url() . '/' . $dir);

        $this->storage->save($this->block);

        $this->fs->hasChild($dir);
    }

    public function testExceptionIsThrownIfDirectoryCouldNotBeCreated()
    {
        $this->fs->chmod(0);
        $dir = $this->fs->url() . '/sub';
        $this->storage = new Filesystem($dir);

        $this->expectException(RuntimeException::class);
        $this->storage->save($this->block);
    }

    public function testExceptionIsThrownIfDirectoryIsNotWritable()
    {
        $subDirName = 'sub';
        $subDirectory = vfsStream::newDirectory($subDirName);
        $subDirectory->chmod(0444);
        $this->fs->addChild($subDirectory);
        $this->storage = new Filesystem($this->fs->url() . '/' . $subDirName);

        $this->expectException(RuntimeException::class);
        $this->storage->save($this->block);
    }

    public function testLoad()
    {
        $this->storage->save($this->block);

        $loaded = $this->storage->load($this->block->getId());

        $this->assertInstanceOf(BlockInterface::class, $loaded);
    }

    public function testDelete()
    {
        $this->storage->save($this->block);

        $this->storage->delete($this->block);

        $this->expectException(BlockNotFoundException::class);
        $this->storage->load($this->block->getId());
    }
}
