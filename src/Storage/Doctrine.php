<?php
declare(strict_types=1);

namespace Midnight\Block\Storage;

use Doctrine\Common\Persistence\ObjectManager;
use Midnight\Block\AbstractBlock;
use Midnight\Block\BlockInterface;

class Doctrine implements StorageInterface
{
    /** @var ObjectManager */
    private $objectManager;

    private $class = AbstractBlock::class;

    /**
     * @param BlockInterface $block
     *
     * @return void
     */
    public function save(BlockInterface $block): void
    {
        $objectManager = $this->getObjectManager();
        $objectManager->persist($block);
        $objectManager->flush();
    }

    /**
     * @param string $id
     *
     * @return BlockInterface
     */
    public function load(string $id): BlockInterface
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @param BlockInterface $block
     *
     * @return void
     */
    public function delete(BlockInterface $block): void
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param ObjectManager $objectManager
     */
    public function setObjectManager($objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @return ObjectManager
     */
    private function getObjectManager(): ObjectManager
    {
        return $this->objectManager;
    }

    private function getRepository()
    {
        return $this->getObjectManager()->getRepository($this->getClass());
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }
}
