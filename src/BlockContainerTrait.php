<?php
declare(strict_types=1);

namespace Midnight\Block;

use SplDoublyLinkedList;
use Zend\Stdlib\ArrayUtils;
use Zend\Stdlib\Exception\InvalidArgumentException;

trait BlockContainerTrait
{
    /** @var BlockInterface[]|SplDoublyLinkedList */
    private $blocks;

    public function addBlock(BlockInterface $block, ?int $position = null): void
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
     * @throws InvalidArgumentException
     */
    public function getBlocks(): array
    {
        $this->ensureBlocks();
        return ArrayUtils::iteratorToArray($this->blocks);
    }

    public function removeBlock(BlockInterface $block): void
    {
        foreach ($this->blocks as $index => $currentBlock) {
            if ($currentBlock === $block) {
                $this->blocks->offsetUnset($index);
            }
        }
    }

    public function moveBlock(BlockInterface $block, int $position): void
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
