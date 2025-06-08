<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\DTOs;

final class FilterLabTestDto
{
    public function __construct(
        public readonly ?string $name = null,
        public readonly ?string $synonym = null,
        public readonly ?string $categoryId = null,
        public readonly ?int $code = null,
        public readonly ?string $codeIcd = null,
    ) {}
}
