<?php

declare(strict_types=1);

namespace Modules\LabTest\Domain\Factories;

use Ramsey\Uuid\Uuid;
use Modules\LabTest\Domain\Models\LabTestCategory;
use Modules\Common\Domain\Factories\LangSetFactory;

class LabTestCategoryFactory
{
    public static function create(array $data): LabTestCategory
    {
        $nameLangSet = LangSetFactory::create($data['name']);

        return new LabTestCategory(
            id: Uuid::uuid4(),
            nameLangSet: $nameLangSet,
            nameLangSetId: $nameLangSet->getId(),
            public: $data['public'],
            deleted: false,
            ord: $data['ord'] ?? 0
        );
    }
}
