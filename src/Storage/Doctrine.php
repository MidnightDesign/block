<?php
declare(strict_types=1);

namespace Midnight\Block\Storage;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Midnight\Block\MutableBlock;
use Midnight\Block\BlockInterface;

class Doctrine implements StorageInterface
{
    /** @var ObjectManager */
    private $objectManager;
    /** @var string */
    private $class = MutableBlock::class;

    public function save(BlockInterface $block): void
    {
        $objectManager = $this->getObjectManager();
        $objectManager->persist($block);
        $objectManager->flush();
    }

    public function load(string $id): BlockInterface
    {
        $block = $this->getRepository()->find($id);
        \assert($block instanceof BlockInterface);
        return $block;
    }

    public function delete(BlockInterface $block): void
    {
        // TODO: Implement delete() method.
    }

    public function setObjectManager(ObjectManager $objectManager): void
    {
        $this->objectManager = $objectManager;
    }

    private function getObjectManager(): ObjectManager
    {
        return $this->objectManager;
    }

    private function getRepository(): ObjectRepository
    {
        return $this->getObjectManager()->getRepository($this->getClass());
    }

    public function getClass(): string
    {
        return $this->class;
    }
}
