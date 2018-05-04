<?php declare(strict_types=1);

namespace Midnight\Block\Persistence\File;

final class PhpFunctionsFilesystem implements FilesystemInterface
{
    public function writeFile(string $fileName, string $content): void
    {
        \file_put_contents($fileName, $content);
    }

    public function readFile(string $fileName): string
    {
        return \file_get_contents($fileName);
    }
}
