<?php

namespace Midnight\Block\Exception;

use Exception;

class BlockNotFoundException extends Exception
{
    /**
     * @param string $id
     * @return BlockNotFoundException
     */
    public static function fromId($id)
    {
        return new self(sprintf('Could not find a block with an ID of "%s".', $id));
    }
} 
