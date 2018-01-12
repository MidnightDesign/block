<?php
declare(strict_types=1);

namespace Midnight\Block;

use Midnight\Block\Exception\BlockNotFoundException;

class BlockList implements BlockListInterface
{
    /** @var BlockInterface[] */
    private $blocks;

    /**
     * @throws \Midnight\Block\Exception\BlockNotFoundException
     * @throws BlockNotFoundException
     */
    public function add(BlockInterface $block, ?int $position = null): void
    {
        $this->blocks[] = $block;
        if ($position !== null && isset($this->blocks[$position])) {
            $this->setPosition($block, $position);
        }
    }

    /**
     * @throws Exception\BlockNotFoundException
     */
    public function setPosition(BlockInterface $block, int $position): void
    {
        foreach ($this->blocks as $index => $b) {
            if ($b === $block) {
                $oldPosition = $index;
            }
        }
        if (!isset($oldPosition)) {
            throw new BlockNotFoundException();
        }
        $this->moveElement($this->blocks, $oldPosition, $position);
    }

    private function moveElement(array &$array, int $from, int $to): void
    {
        $out = array_splice($array, $from, 1);
        array_splice($array, $to, 0, $out);
    }

    /**
     * @return BlockInterface[]
     */
    public function getAll(): array
    {
        if (empty($this->blocks)) {
            $this->blocks = [];
        }
        return $this->blocks;
    }

    public function remove(BlockInterface $block): void
    {
        $keys = array_keys($this->blocks, $block);
        foreach ($keys as $k) {
            unset($this->blocks[$k]);
        }
    }
}
