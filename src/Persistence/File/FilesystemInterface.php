<?php declare(strict_types=1);

namespace Midnight\Block\Persistence\File;

interface FilesystemInterface
{
    public function writeFile(string $fileName, string $content): void;

    public function readFile(string $fileName): string;

    /**
     * @return string[]
     */
    public function readFiles(): array;
}
