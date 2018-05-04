<?php declare(strict_types=1);

namespace Midnight\Block\Type;

use Midnight\Block\Block;
use Midnight\Block\Persistence\BlockRepositoryInterface;
use Midnight\Block\View\BlockRendererInterface;

final class BlockListType extends AbstractType implements BlockRendererInterface
{
    private const BLOCK_IDS = 'block_ids';
    private const TYPE = 'block_list';
    /** @var BlockRepositoryInterface */
    private $blockRepository;
    /** @var BlockRendererInterface */
    private $childBlockRenderer;

    public function __construct(BlockRepositoryInterface $blockRepository, BlockRendererInterface $childBlockRenderer)
    {
        $this->blockRepository = $blockRepository;
        $this->childBlockRenderer = $childBlockRenderer;
    }

    public function create(Block ...$childBlocks): Block
    {
        $blockIds = \array_map([$this, 'getBlockId'], $childBlocks);
        return (new Block())
            ->withType(self::TYPE)
            ->withArray(self::BLOCK_IDS, $blockIds);
    }

    public function render(Block $block): string
    {
        $blocks = $this->loadChildBlocks($block);
        $renderedBlocks = \array_map([$this->childBlockRenderer, 'render'], $blocks);
        return \sprintf('<section>%s</section>', \implode('', $renderedBlocks));
    }

    private function getBlockId(Block $block): string
    {
        return $block->getId();
    }

    /**
     * @return Block[]
     */
    private function loadChildBlocks(Block $block): array
    {
        return \array_map([$this->blockRepository, 'findById'], $block->getArray(self::BLOCK_IDS));
    }
}
