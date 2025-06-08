<?php

declare(strict_types=1);

namespace Modules\LabTest\Infrastructure\Repositories;

use Modules\LabTest\Domain\Models\LabTest;
use Modules\LabTest\Application\DTOs\FilterLabTestDto;
use Modules\LabTest\Application\DTOs\LabTestDto;
use Modules\LabTest\Application\Mappers\LabTestMapper;
use Modules\LabTest\Domain\Collections\LabTestCollection;
use Modules\LabTest\Domain\Repositories\LabTestRepositoryInterface;
use Modules\LabTest\Infrastructure\EloquentModels\LabTest as LabTestEloquent;


class LabTestRepository implements LabTestRepositoryInterface
{
    public function filterLabTests(FilterLabTestDto $filterDto): LabTestCollection
    {
        $query = LabTestEloquent::with(['name.langs', 'description.langs', 'synonyms.name', 'categories', 'categories.name.langs'])->where('public', true)->where('deleted', false);

        if ($filterDto->name !== null) {
            $query->whereHas('name.langs', function ($q) use ($filterDto) {
                $q->where('value', 'like', '%' . $filterDto->name . '%');
            });
        }
        if ($filterDto->categoryId !== null) {
            $query->where('category_id', $filterDto->categoryId);
        }

        if ($filterDto->synonym !== null) {
            $query->whereHas('synonyms', function ($q) use ($filterDto) {
                $q->where('name', 'like', '%' . $filterDto->synonym . '%');
            });
        }
        if ($filterDto->code !== null) {
            $query->where('code', $filterDto->code);
        }
        if ($filterDto->codeIcd !== null) {
            $query->where('code_icd', 'like', '%' . $filterDto->codeIcd . '%');
        }

        return new LabTestCollection($query->get()->map(fn(LabTestEloquent $model) => LabTestMapper::fromDatabase($model->toArray()))->all());
    }

    public function findById(string $id): ?LabTest
    {
        $model = LabTestEloquent::with(['name.langs', 'description.langs', 'synonyms.name', 'categories.name.langs'])->find($id);
        return $model->exists() ? LabTestMapper::fromDatabase($model->toArray()) : null;
    }

    public function save(LabTest $labTest): LabTest
    {
        $model = LabTestEloquent::updateOrCreate(
            ['id' => $labTest->getId()->toString()],
            [
                'code' => $labTest->getCode(),
                'code_icd' => $labTest->getCodeIcd(),
                'name_lang_set_id' => $labTest->getNameLangSet()->getId()->toString(),
                'description_lang_set_id' => $labTest->getDescriptionLangSet()->getId()->toString(),
                'public' => $labTest->isPublic(),
                'deleted' => $labTest->isDeleted(),
                'ord' => $labTest->getOrd(),
            ]
        );

        $model->load(['name.langs', 'description.langs', 'synonyms.name', 'categories.name.langs']);

        return LabTestMapper::fromDatabase($model->toArray());
    }

    public function delete(string $id): void
    {
        $model = LabTestEloquent::findOrFail($id);
        $model->delete();
    }

    public function updateCategories(LabTest $labTest, array $categoryIds): LabTest
    {
        $model = LabTestEloquent::with(['name.langs', 'description.langs', 'synonyms.name', 'categories.name.langs'])->find($labTest->getId()->toString());
        $model->categories()->detach();
        foreach ($categoryIds as $categoryId) {
            $model->categories()->attach($categoryId);
        }
        $model->load('categories.name.langs');
        return LabTestMapper::fromDatabase($model->toArray());
    }
}
