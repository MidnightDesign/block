<?php
declare(strict_types=1);

namespace Midnight\Block;

interface BlockInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @param string $id
     *
     * @return void
     */
    public function setId($id);
}
