<?php declare(strict_types=1);

namespace Midnight\Block\Persistence\File;

use Midnight\Block\Block;
use PHPUnit\Framework\TestCase;

class FileBlockStorageRepositoryTest extends TestCase
{
    public function testPersistAndLoadWithDefaults()
    {
        \chdir(__DIR__);
        $repository = new FileBlockStorageRepository();
        $id = 'test-block';
        $block = Block::withId($id)->withString('foo', 'bar');

        $repository->persist($block);
        $loaded = $repository->findById($block->getId());

        $this->assertSame($block->getId(), $loaded->getId());
        $this->assertTrue($loaded->equals($block));
        \unlink($id . '.json');
    }
}
