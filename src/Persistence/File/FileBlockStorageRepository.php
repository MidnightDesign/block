<?php declare(strict_types=1);

namespace Midnight\Block\Persistence\File;

use Midnight\Block\Block;
use Midnight\Block\Persistence\BlockRepositoryInterface;
use Midnight\Block\Persistence\BlockStorageInterface;

final class FileBlockStorageRepository implements BlockStorageInterface, BlockRepositoryInterface
{
    /** @var FilesystemInterface */
    private $filesystem;
    /** @var FileNameBuilderInterface */
    private $fileNameBuilder;
    /** @var BlockSerializerInterface */
    private $serializer;

    public function __construct(
        FilesystemInterface $filesystem = null,
        FileNameBuilderInterface $fileNameBuilder = null,
        BlockSerializerInterface $serializer = null
    ) {
        $this->filesystem = $filesystem ?? new PhpFunctionsFilesystem();
        $this->fileNameBuilder = $fileNameBuilder ?? new SuffixFileNameBuilder(new IdFileNameBuilder(), '.json');
        $this->serializer = $serializer ?? new JsonBlockSerializer();
    }

    public function persist(Block $block): void
    {
        $fileName = $this->fileNameBuilder->fromBlock($block);
        $fileContent = $this->serializer->serialize($block);
        $this->filesystem->writeFile($fileName, $fileContent);
    }

    public function findById(string $id): Block
    {
        $fileName = $this->fileNameBuilder->fromId($id);
        $serialized = $this->filesystem->readFile($fileName);
        return $this->serializer->deserialize($serialized);
    }
}
