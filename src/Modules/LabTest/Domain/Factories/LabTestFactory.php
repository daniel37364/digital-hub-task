<?php

declare(strict_types=1);

namespace Modules\LabTest\Domain\Factories;

use Modules\Common\Domain\Factories\LangSetFactory;
use Modules\LabTest\Domain\Models\LabTest;
use Ramsey\Uuid\Uuid;

class LabTestFactory
{
    public static function create(array $data): LabTest
    {
        $nameLangSet = LangSetFactory::create($data['name']);
        $descriptionLangSet = LangSetFactory::create($data['description']);

        return new LabTest(
            id: $data['id'] ?? Uuid::uuid4(),
            code: $data['code'],
            codeIcd: $data['codeIcd'],
            nameLangSet: $nameLangSet,
            nameLangSetId: $nameLangSet->getId(),
            descriptionLangSet: $descriptionLangSet,
            descriptionLangSetId: $descriptionLangSet->getId(),
            public: $data['public'] ?? false,
            deleted: $data['deleted'] ?? false,
            ord: $data['ord'] ?? 0,
            categories: $data['categories'] ?? null
        );
    }
}
