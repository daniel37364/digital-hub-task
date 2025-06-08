<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\DTOs;

class LabTestCategoryResponseDto
{
    public function __construct(
        public string $id,
        public array $name,
        public int $ord
    ) {}
}
