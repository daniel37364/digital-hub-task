<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\Mappers;

use Modules\LabTest\Application\DTOs\LabTestCategoryDto;

class LabTestCategoryMapper
{
    public static function fromArray(array $model): LabTestCategoryDto
    {
        return new LabTestCategoryDto(
            id: $model['id'],
            nameLangSetId: $model['name_lang_set_id'],
            public: $model['public'],
            deleted: $model['deleted'],
            ord: $model['ord'],
            labTests: isset($model['labTests']) ? array_map(fn($test) => $test->toArray(), $model['labTests']) : null,
            nameLangSet: $model['nameLangSet']->toArray(),
            descriptionLangSet: $model['descriptionLangSet']->toArray()
        );
    }
}
