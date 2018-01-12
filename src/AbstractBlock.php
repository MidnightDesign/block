<?php

namespace Midnight\Block;

abstract class AbstractBlock implements BlockInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return void
     */
    public function setId($id): void
    {
        $this->id = $id;
    }
}
