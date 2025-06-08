<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\Mappers;

use Modules\LabTest\Application\DTOs\LabTestCategoryUpdateDto;

class LabTestCategoryUpdateMapper
{
    public static function fromArray(array $data): LabTestCategoryUpdateDto
    {
        return new LabTestCategoryUpdateDto(
            id: $data['id'],
            name: $data['name'] ?? null,
            public: $data['public'] ?? null,
            ord: $data['ord'] ?? null,
            labTests: $data['lab_tests'] ?? null,
        );
    }
}
