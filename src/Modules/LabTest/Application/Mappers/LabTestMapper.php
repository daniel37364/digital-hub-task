<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\Mappers;

use Ramsey\Uuid\Nonstandard\Uuid;
use Modules\Common\Domain\Models\LangSet;
use Modules\LabTest\Domain\Models\LabTest;
use Modules\LabTest\Application\DTOs\LabTestDto;
use Modules\LabTest\Domain\Models\LabTestCategory;
use Modules\Common\Application\Mappers\LangSetMapper;
use Modules\LabTest\Application\DTOs\LabTestResponeDto;
use Modules\LabTest\Application\Mappers\LabTestCategoryMapper;
use Modules\LabTest\Domain\Collections\LabTestCategoryCollection;
use Modules\LabTest\Domain\Collections\LabTestCollection;
use Modules\LabTest\Infrastructure\EloquentModels\LabTest as LabTestEloquent;


class LabTestMapper
{
    public static function fromArray(array $data): LabTestDto
    {
        return new LabTestDto(
            id: $data['id'] ?? null,
            code: $data['code'],
            code_icd: $data['code_icd'],
            name: $data['name'],
            description: $data['description'],
            public: $data['public'],
            deleted: $data['deleted'] ?? false,
            ord: $data['ord'] ?? 0,
            // categories: isset($data['categories']) ? LabTestCategoryMapper::fromArray($data['categories']) : null
        );
    }

    public static function fromDatabase(array $data): LabTest
    {
        return new LabTest(
            id: Uuid::fromString($data['id']),
            code: $data['code'],
            codeIcd: $data['code_icd'],
            nameLangSetId: Uuid::fromString($data['name_lang_set_id']),
            descriptionLangSetId: Uuid::fromString($data['description_lang_set_id']),
            public: $data['public'],
            deleted: $data['deleted'],
            ord: $data['ord'],
            nameLangSet: LangSetMapper::fromDatabase($data['name']),
            descriptionLangSet: LangSetMapper::fromDatabase($data['description']),
            categories: isset($data['categories']) ? new LabTestCategoryCollection(array_map(function ($categoryData) {
                return LabTestCategoryMapper::fromDatabase($categoryData);
            }, $data['categories'])) : null
        );
    }

    public static function toDto(LabTest $labTest): LabTestDto
    {
        return new LabTestDto(
            id: $labTest->getId()->toString(),
            code: $labTest->getCode(),
            code_icd: $labTest->getCodeIcd(),
            name: LangSetMapper::toDto($labTest->getNameLangSet())->langs,
            description: LangSetMapper::toDto($labTest->getDescriptionLangSet())->langs,
            public: $labTest->isPublic(),
            deleted: $labTest->isDeleted(),
            ord: $labTest->getOrd(),
            // categories: $labTest->getCategories() ? LabTestCategoryMapper::toDtoCollection($labTest->getCategories()) : null
        );
    }

    public static function toDtos(LabTestCollection $labTests): array
    {
        return array_map(
            fn(LabTest $labTest) => self::toDto($labTest),
            $labTests->toArray()
        );
    }


    public static function toResponseDto(LabTest $labTest): LabTestResponeDto
    {

        return new LabTestResponeDto(
            id: $labTest->getId()->toString(),
            code: $labTest->getCode(),
            code_icd: $labTest->getCodeIcd(),
            name: LangSetMapper::toDto($labTest->getNameLangSet())->langs,
            description: LangSetMapper::toDto($labTest->getDescriptionLangSet())->langs,
            ord: $labTest->getOrd(),
            categories: $labTest->getCategories() ? LabTestCategoryMapper::toResponseDtos($labTest->getCategories()) : null
        );
    }

    public static function toResponseDtos(LabTestCollection $labTests): array
    {
        return array_map(
            fn(LabTest $labTest) => self::toResponseDto($labTest),
            $labTests->toArray()
        );
    }
}
