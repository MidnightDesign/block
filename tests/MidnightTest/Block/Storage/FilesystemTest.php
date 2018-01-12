<?php
declare(strict_types=1);

namespace MidnightTest\Block\Storage;

use Midnight\Block\BlockInterface;
use Midnight\Block\Storage\Filesystem;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class FilesystemTest extends TestCase
{
    /** @var string */
    private static $directory;
    /** @var Filesystem */
    private $storage;
    /** @var BlockInterface|PHPUnit_Framework_MockObject_MockObject */
    private $block;

    public static function setUpBeforeClass()
    {
        self::$directory = __DIR__ . '/generated';
        mkdir(self::$directory);
    }

    public static function tearDownAfterClass()
    {
        self::delDir(self::$directory);
    }

    public function setUp()
    {
        $this->storage = new Filesystem(self::$directory);

        $this->block = $this->createMock(BlockInterface::class);
        $this->block
            ->expects($this->any())
            ->method('getId')
            ->will($this->returnValue('myTestId'));
    }

    public function tearDown()
    {
        self::emptyDir(self::$directory);
        chmod(self::$directory, 0777);
    }

    public function testSave()
    {
        $this->block
            ->expects($this->any())
            ->method('getId')
            ->will($this->returnValue('myTestId'));
        $block = $this->block;
        $this->storage->save($block);
        $this->assertFileExists(self::$directory . '/' . $block->getId());
    }

    public function testDirectoryIsCreatedIfItDoesNotExist()
    {
        $storage = $this->storage;
        $dir = self::$directory . '/sub';
        $storage->setDirectory($dir);
        $storage->save($this->block);
        $this->assertFileExists($dir);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testExceptionIsThrownIfDirectoryCouldNotBeCreated()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $this->markTestSkipped('Not necessary on Windows.');
        }
        chmod(self::$directory, 0000);
        $dir = self::$directory . '/sub';
        $this->storage->setDirectory($dir);
        $this->storage->save($this->block);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testExceptionIsThrownIfDirectoryIsNotReadable()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $this->markTestSkipped('Not necessary on Windows.');
        }
        $dir = self::$directory . '/sub';
        mkdir($dir);
        chmod($dir, 0000);
        $this->storage->setDirectory($dir);
        $this->storage->save($this->block);
    }

    /**
     * @expectedException \RuntimeException
     */
    public function testExceptionIsThrownIfDirectoryIsNotWritable()
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $this->markTestSkipped('Not necessary on Windows.');
        }
        $dir = self::$directory . '/sub';
        mkdir($dir);
        chmod($dir, 0444);
        $this->storage->setDirectory($dir);
        $this->storage->save($this->block);
    }

    public function testLoad()
    {
        $storage = $this->storage;
        $block = $this->block;
        $storage->save($block);
        $this->assertInstanceOf(BlockInterface::class, $storage->load($block->getId()));
    }

    public function testDelete()
    {
        $block = $this->block;
        $storage = $this->storage;
        $storage->save($block);
        $storage->delete($block);
        $this->assertNull($storage->load($block->getId()));
    }

    private static function delDir($dir)
    {
        self::emptyDir($dir);
        return rmdir($dir);
    }

    private static function emptyDir($dir)
    {
        chmod($dir, 0777);
        $files = array_diff(scandir($dir), ['.', '..']);
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? self::delDir("$dir/$file") : unlink("$dir/$file");
        }
    }
}
