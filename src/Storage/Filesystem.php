<?php

namespace Midnight\Block\Storage;

use Midnight\Block\BlockInterface;

class Filesystem implements StorageInterface
{
    /**
     * @var string
     */
    private $directory;

    function __construct($directory)
    {
        $this->setDirectory($directory);
    }

    /**
     * @param BlockInterface $block
     *
     * @return void
     */
    public function save(BlockInterface $block)
    {
        $id = $block->getId();
        if (!$id) {
            $block->setId(uniqid());
            $id = $block->getId();
        }
        file_put_contents($this->buildPath($id), serialize($block));
    }

    /**
     * @param string $id
     *
     * @return string
     */
    private function buildPath($id)
    {
        return $this->getDirectory() . DIRECTORY_SEPARATOR . $id;
    }

    /**
     * @return string
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * @param string $directory
     */
    public function setDirectory($directory)
    {
        $directory = realpath($directory);
        $this->directory = $directory;
    }

    /**
     * @param string $id
     *
     * @return BlockInterface
     */
    public function load($id)
    {
        return unserialize(file_get_contents($this->buildPath($id)));
    }
}
