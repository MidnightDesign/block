<?php

namespace Midnight\Block\Storage;

use Midnight\Block\BlockInterface;

class Filesystem implements StorageInterface
{
    /**
     * @var string
     */
    private $directory;

    /**
     * @param string $directory
     */
    public function __construct($directory)
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
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        if (!file_exists($directory)) {
            throw new \RuntimeException(sprintf('Couldn\'t create "%s".', $directory));
        }
        if (!is_readable($directory)) {
            throw new \RuntimeException(sprintf('"%s" is not readable.', $directory));
        }
        if (!is_writable($directory)) {
            throw new \RuntimeException(sprintf('"%s" is not writable.', $directory));
        }
        $directory = realpath(($directory));
        $this->directory = $directory;
    }

    /**
     * @param string $id
     *
     * @return BlockInterface
     */
    public function load($id)
    {
        $path = $this->buildPath($id);
        if (!is_file($path)) {
            return null;
        }
        return unserialize(file_get_contents($path));
    }

    /**
     * @param BlockInterface $block
     *
     * @return void
     */
    public function delete(BlockInterface $block)
    {
        unlink($this->buildPath($block->getId()));
    }
}
