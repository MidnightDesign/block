<?php declare(strict_types=1);

namespace Midnight\Block\Persistence\File;

use Midnight\Block\Block;

final class SuffixFileNameBuilder implements FileNameBuilderInterface
{
    /** @var FileNameBuilderInterface */
    private $baseBuilder;
    /** @var string */
    private $suffix;

    public function __construct(FileNameBuilderInterface $baseBuilder, string $suffix)
    {
        $this->baseBuilder = $baseBuilder;
        $this->suffix = $suffix;
    }

    public function fromBlock(Block $block): string
    {
        return $this->baseBuilder->fromBlock($block) . $this->suffix;
    }

    public function fromId(string $id): string
    {
        return $this->baseBuilder->fromId($id) . $this->suffix;
    }
}
