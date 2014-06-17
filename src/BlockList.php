<?php

namespace Midnight\Block;

use Midnight\Block\Exception\BlockNotFoundException;
use Traversable;

class BlockList implements BlockListInterface
{
    /**
     * @var BlockInterface[]|Traversable
     */
    private $blocks;

    /**
     * @param BlockInterface $block
     * @param null|int       $position
     */
    public function add(BlockInterface $block, $position = null)
    {
        $this->blocks[] = $block;
        if (isset($this->blocks[$position])) {
            $this->setPosition($block, $position);
        }
    }

    /**
     * @param BlockInterface $block
     * @param int            $position
     *
     * @throws Exception\BlockNotFoundException
     */
    public function setPosition(BlockInterface $block, $position)
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

    /**
     * @param array $array
     * @param int   $from
     * @param int   $to
     */
    private function moveElement(array &$array, $from, $to)
    {
        $out = array_splice($array, $from, 1);
        array_splice($array, $to, 0, $out);
    }

    /**
     * @return BlockInterface[]
     */
    public function getAll()
    {
        if (empty($this->blocks)) {
            $this->blocks = array();
        }
        //@codeCoverageIgnoreStart
        if ($this->blocks instanceof Traversable) {
            $this->blocks = iterator_to_array($this->blocks);
        }
        //@codeCoverageIgnoreEnd
        return $this->blocks;
    }

    /**
     * @param BlockInterface $block
     *
     * @return void
     */
    public function remove(BlockInterface $block)
    {
        $keys = array_keys($this->blocks, $block);
        foreach ($keys as $k) {
            unset($this->blocks[$k]);
        }
    }
}
