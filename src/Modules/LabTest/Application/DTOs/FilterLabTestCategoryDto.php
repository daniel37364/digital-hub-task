<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\DTOs;

final class FilterLabTestCategoryDto
{
    public function __construct(
        public readonly ?string $name = null,
    ) {}
}
