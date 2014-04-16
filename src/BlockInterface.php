<?php

namespace Midnight\Block;

interface BlockInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @param string $id
     * @return void
     */
    public function setId($id);
}