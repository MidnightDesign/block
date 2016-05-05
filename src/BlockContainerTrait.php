<?php

namespace Midnight\Block;

trait BlockContainerTrait
{
    /**
     * @var BlockInterface[]
     */
    private $blocks = [];

    /**
     * @param BlockInterface $block
     * @param int|null $position
     * @return void
     */
    public function addBlock(BlockInterface $block, $position = null)
    {
        if ($this->hasBlock($block)) {
            if (null !== $position) {
                $this->moveBlock($block, $position);
            }
            return;
        }
        if ($position === null || !isset($this->blocks[$position])) {
            $this->blocks[] = $block;
        } else {
            array_splice($this->blocks, $position, 0, [$block]);
        }
    }

    /**
     * @return BlockInterface[]
     */
    public function getBlocks()
    {
        return $this->blocks;
    }

    /**
     * @param BlockInterface $block
     * @return void
     */
    public function removeBlock(BlockInterface $block)
    {
        $index = array_search($block, $this->blocks, true);
        if ($index === false) {
            return;
        }
        array_splice($this->blocks, $index,1);
    }

    /**
     * @param BlockInterface $block
     * @param int $position
     * @return void
     */
    public function moveBlock(BlockInterface $block, $position)
    {
        $this->removeBlock($block);
        $this->addBlock($block, $position);
    }

    private function hasBlock(BlockInterface $block)
    {
        return array_search($block, $this->blocks, true) !== false;
    }
}
