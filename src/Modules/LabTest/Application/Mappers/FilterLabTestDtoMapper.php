<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\Mappers;

use Illuminate\Http\Request;
use Modules\LabTest\Application\DTOs\FilterLabTestDto;

class FilterLabTestDtoMapper
{
    public static function fromArray(array $data): FilterLabTestDto
    {
        return new FilterLabTestDto(
            name: $data['name'] ?? null,
            synonym: $data['synonym'] ?? null,
            categoryId: $data['category_id'] ?? null,
            code: isset($data['code']) ? (int) $data['code'] : null,
            codeIcd: $data['code_icd'] ?? null
        );
    }
}
