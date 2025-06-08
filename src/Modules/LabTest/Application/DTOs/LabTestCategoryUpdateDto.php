<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\DTOs;

class LabTestCategoryUpdateDto
{
    public function __construct(
        public string $id,
        public ?array $name = null,
        public ?bool $public = null,
        public ?int $ord = null,
        public readonly ?array $labTests = null,
    ) {}
}
