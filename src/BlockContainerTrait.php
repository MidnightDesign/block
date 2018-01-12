<?php
declare(strict_types=1);

namespace Midnight\Block;

use SplDoublyLinkedList;
use Zend\Stdlib\ArrayUtils;

trait BlockContainerTrait
{
    /**
     * @var BlockInterface[]|SplDoublyLinkedList
     */
    private $blocks;

    /**
     * @param BlockInterface $block
     * @param int|null       $position
     * @return void
     */
    public function addBlock(BlockInterface $block, $position = null): void
    {
        $this->ensureBlocks();
        if ($this->hasBlock($block)) {
            if (null !== $position) {
                $this->moveBlock($block, $position);
            }
            return;
        }
        if (null !== $position && $this->blocks->offsetExists($position)) {
            $this->blocks->add($position, $block);
        } else {
            $this->blocks->push($block);
        }
    }

    /**
     * @return BlockInterface[]
     */
    public function getBlocks(): array
    {
        $this->ensureBlocks();
        return ArrayUtils::iteratorToArray($this->blocks);
    }

    /**
     * @param BlockInterface $block
     * @return void
     */
    public function removeBlock(BlockInterface $block): void
    {
        foreach ($this->blocks as $index => $currentBlock) {
            if ($currentBlock === $block) {
                $this->blocks->offsetUnset($index);
            }
        }
    }

    /**
     * @param BlockInterface $block
     * @param int            $position
     * @return void
     */
    public function moveBlock(BlockInterface $block, $position): void
    {
        $this->removeBlock($block);
        $this->addBlock($block, $position);
    }

    private function ensureBlocks(): void
    {
        if (null === $this->blocks) {
            $this->blocks = new SplDoublyLinkedList();
        }
    }

    private function hasBlock(BlockInterface $block): bool
    {
        foreach ($this->blocks as $index => $currentBlock) {
            if ($currentBlock === $block) {
                return true;
            }
        }
        return false;
    }
}
