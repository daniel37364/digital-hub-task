<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\Mappers;

use Illuminate\Http\Request;
use Modules\LabTest\Application\DTOs\FilterLabTestCategoryDto;

class FilterLabTestCategoryDtoMapper
{
    public static function fromArray(array $data): FilterLabTestCategoryDto
    {
        return new FilterLabTestCategoryDto(
            name: $data['name'] ?? null,
        );
    }
}
