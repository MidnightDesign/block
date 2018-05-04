<?php declare(strict_types=1);

namespace Midnight\Block\Persistence;

use Midnight\Block\Block;

interface BlockRepositoryInterface
{
    /**
     * @throws Exception\UnknownBlockException
     */
    public function findById(string $id): Block;

    /**
     * @return Block[]
     */
    public function findAll(): array;
}
