<?php declare(strict_types=1);

namespace Midnight\Block\Type\Attribute;

interface AttributeInterface
{
    public function getName(): string;

    public function getDefault(): ?string;

    public function validate(?string $value): void;
}
