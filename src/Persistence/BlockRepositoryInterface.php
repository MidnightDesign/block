<?php declare(strict_types=1);

namespace Midnight\Block\Persistence;

use Midnight\Block\BlockInterface;

interface BlockRepositoryInterface
{
    /**
     * @throws Exception\UnknownBlockException
     */
    public function findById(string $id): BlockInterface;
}
