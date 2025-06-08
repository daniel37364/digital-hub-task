<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\DTOs;

final class LabTestCategoryDto
{
    public function __construct(
        public readonly string $id,
        public readonly string $nameLangSetId,
        public readonly bool $public,
        public readonly bool $deleted,
        public readonly int $ord,

        public readonly ?array $labTests = null,
        public readonly array $nameLangSet,
        public readonly array $descriptionLangSet
    ) {}
}
