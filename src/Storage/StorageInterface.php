<?php

namespace Midnight\Block\Storage;

use Midnight\Block\BlockInterface;

interface StorageInterface
{
    /**
     * @param BlockInterface $block
     *
     * @return void
     */
    public function save(BlockInterface $block);

    /**
     * @param string $id
     *
     * @return BlockInterface
     */
    public function load($id);
}
