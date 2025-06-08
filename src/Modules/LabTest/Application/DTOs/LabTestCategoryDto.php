<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\DTOs;

final class LabTestCategoryDto
{
    public function __construct(
        public readonly ?string $id,
        public readonly array $name,
        public readonly bool $public,
        public readonly bool $deleted,
        public readonly int $ord,

    ) {}
}
