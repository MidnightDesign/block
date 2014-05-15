<?php

namespace Midnight\Block\Storage;

use Doctrine\Common\Persistence\ObjectManager;
use Midnight\Block\BlockInterface;

class Doctrine implements StorageInterface
{
    /**
     * @var ObjectManager
     */
    private $objectManager;

    private $class = 'Midnight\Block\AbstractBlock';

    /**
     * @param BlockInterface $block
     *
     * @return void
     */
    public function save(BlockInterface $block)
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
    public function load($id)
    {
        return $this->getRepository()->find($id);
    }

    /**
     * @param BlockInterface $block
     *
     * @return void
     */
    public function delete(BlockInterface $block)
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
    private function getObjectManager()
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
    public function getClass()
    {
        return $this->class;
    }
}
