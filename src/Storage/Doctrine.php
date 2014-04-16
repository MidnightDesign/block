<?php

namespace Midnight\Block\Storage;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;
use Midnight\Block\BlockInterface;
use RuntimeException;

class Doctrine implements StorageInterface
{
    /**
     * @var ObjectManager
     */
    private $objectManager;
    /**
     * @var string
     */
    private $className;

    /**
     * @param BlockInterface $block
     * @return void
     */
    public function save(BlockInterface $block)
    {
        $documentManager = $this->getObjectManager();
        $documentManager->persist($block);
        $documentManager->flush();
    }

    /**
     * @throws RuntimeException
     * @return ObjectRepository
     */
    public function getRepository()
    {
        $className = $this->getClassName();
        if (!$className) {
            throw new RuntimeException('No target class set.');
        }
        return $this->getObjectManager()->getRepository($className);
    }

    /**
     * @throws RuntimeException
     * @return ObjectManager
     */
    public function getObjectManager()
    {
        $objectManager = $this->objectManager;
        if (!$objectManager) {
            throw new RuntimeException('No object manager set.');
        }
        return $objectManager;
    }

    /**
     * @param ObjectManager $objectManager
     */
    public function setObjectManager($objectManager)
    {
        $this->objectManager = $objectManager;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param string $className
     */
    public function setClassName($className)
    {
        $this->className = $className;
    }

    /**
     * @param string $id
     * @return BlockInterface
     */
    public function load($id)
    {
        return $this->getRepository()->find($id);
    }
}