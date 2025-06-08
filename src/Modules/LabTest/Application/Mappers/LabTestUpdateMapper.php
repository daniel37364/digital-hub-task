<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\Mappers;

use Modules\LabTest\Application\DTOs\LabTestUpdateDto;

class LabTestUpdateMapper
{
    public static function fromArray(array $data): LabTestUpdateDto
    {
        return new LabTestUpdateDto(
            id: $data['id'],
            name: $data['name'] ?? null,
            description: $data['description'] ?? null,
            code: $data['code'] ?? null,
            codeIcd: $data['code_icd'] ?? null,
            public: $data['public'] ?? null,
            categories: $data['categories'] ?? null,
        );
    }
}
