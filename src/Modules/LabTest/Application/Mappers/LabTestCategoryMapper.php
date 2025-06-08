<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\Mappers;

use Ramsey\Uuid\Uuid;
use Modules\LabTest\Domain\Models\LabTestCategory;
use Modules\Common\Application\Mappers\LangSetMapper;
use Modules\LabTest\Application\DTOs\LabTestCategoryDto;
use Modules\LabTest\Application\DTOs\LabTestCategoryResponseDto;
use Modules\LabTest\Domain\Collections\LabTestCategoryCollection;

class LabTestCategoryMapper
{
    public static function fromArray(array $model): LabTestCategoryDto
    {
        return new LabTestCategoryDto(
            id: $model['id'] ?? null,
            name: $model['name'],
            public: $model['public'],
            deleted: $model['deleted'] ?? false,
            ord: $model['ord'],
        );
    }

    public static function fromDatabase(array $data): LabTestCategory
    {
        return new LabTestCategory(
            id: Uuid::fromString($data['id']),
            nameLangSetId: Uuid::fromString($data['name_lang_set_id']),
            public: $data['public'],
            deleted: $data['deleted'],
            ord: $data['ord'],
            nameLangSet: LangSetMapper::fromDatabase($data['name']),
            // labTests: isset($data['labTests']) ? LabTestCollection::fromArray($data['labTests']) : null
        );
    }

    public static function toResponseDto(LabTestCategory $category): LabTestCategoryResponseDto
    {
        return new LabTestCategoryResponseDto(
            id: $category->getId()->toString(),
            name: LangSetMapper::toDto($category->getNameLangSet())->langs,
            ord: $category->getOrd()
        );
    }

    public static function toResponseDtos(LabTestCategoryCollection $categories): array
    {
        return array_map(
            fn(LabTestCategory $category) => self::toResponseDto($category),
            $categories->toArray()
        );
    }
}
