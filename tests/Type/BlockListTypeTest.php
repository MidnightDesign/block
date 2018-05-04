<?php declare(strict_types=1);

namespace Midnight\Test\Block\Type;

use Midnight\Block\Block;
use Midnight\Block\Persistence\BlockRepositoryInterface;
use Midnight\Block\Persistence\BlockStorageInterface;
use Midnight\Block\Persistence\MemoryBlockStorageRepository;
use Midnight\Block\Type\BlockListType;
use Midnight\Block\View\BlockRendererInterface;
use Midnight\Block\View\IdBlockRenderer;
use PHPUnit\Framework\TestCase;

class BlockListTypeTest extends TestCase
{
    /** @var BlockStorageInterface|BlockRepositoryInterface */
    private $storageRepository;
    /** @var BlockRendererInterface */
    private $childBlockRenderer;
    /** @var BlockListType */
    private $type;

    protected function setUp()
    {
        parent::setUp();

        $this->childBlockRenderer = new IdBlockRenderer();
        $this->storageRepository = new MemoryBlockStorageRepository();
        $this->type = new BlockListType($this->storageRepository, $this->childBlockRenderer);
    }

    public function testCreateAndRender()
    {
        $childBlocks = [new Block(), new Block(), new Block()];
        foreach ($childBlocks as $childBlock) {
            $this->storageRepository->persist($childBlock);
        }
        $block = $this->type->create(...$childBlocks);

        $rendered = $this->type->render($block);

        $expected = \sprintf(
            '<section>%s</section>',
            \implode('', \array_map([$this->childBlockRenderer, 'render'], $childBlocks))
        );
        $this->assertSame($expected, $rendered);
    }
}
