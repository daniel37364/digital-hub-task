<?php

declare(strict_types=1);

namespace Modules\LabTest\Infrastructure\Repositories;

use Modules\LabTest\Domain\Models\LabTestCategory;
use Modules\LabTest\Application\DTOs\FilterLabTestCategoryDto;
use Modules\LabTest\Application\Mappers\LabTestCategoryMapper;
use Modules\LabTest\Domain\Collections\LabTestCategoryCollection;
use Modules\LabTest\Domain\Repositories\LabTestCategoryRepositoryInterface;
use Modules\LabTest\Infrastructure\EloquentModels\LabTestCategory as LabTestCategoryEloquent;

class LabTestCategoryRepository implements LabTestCategoryRepositoryInterface
{
    public function filterLabTestCategories(FilterLabTestCategoryDto $filterDto): LabTestCategoryCollection
    {
        $query = LabTestCategoryEloquent::with([
            'name.langs',
            'labTests' => fn($q) => $q->where('deleted', false)->where('public', true),
            'labTests.name.langs',
            'labTests.description.langs',
        ])->where('deleted', false)->where('public', true);

        if ($filterDto->name !== null) {
            $query->whereHas('name.langs', function ($q) use ($filterDto) {
                $q->where('value', 'like', '%' . $filterDto->name . '%');
            });
        }
        return new LabTestCategoryCollection(
            $query->get()->map(fn($model) => LabTestCategoryMapper::fromDatabase($model->toArray()))->all()
        );
    }

    public function findById(string $id): ?LabTestCategory
    {
        $model = LabTestCategoryEloquent::with([
            'name.langs',
            'labTests' => fn($q) => $q->where('deleted', false)->where('public', true),
            'labTests.name.langs',
            'labTests.description.langs',
        ])->where('deleted', false)->where('public', true)->find($id);

        return $model ? LabTestCategoryMapper::fromDatabase($model->toArray()) : null;
    }

    public function save(LabTestCategory $labTest): LabTestCategory
    {
        $model = LabTestCategoryEloquent::updateOrCreate(
            ['id' => $labTest->getId()->toString()],
            [
                'name_lang_set_id' => $labTest->getNameLangSet()->getId()->toString(),
                'public' => $labTest->isPublic(),
                'deleted' => $labTest->isDeleted(),
                'ord' => $labTest->getOrd(),
            ]
        );

        $model->load(['name.langs', 'labTests.name.langs', 'labTests.description.langs']);

        return LabTestCategoryMapper::fromDatabase($model->toArray());
    }

    public function updateLabTests(LabTestCategory $labTest, array $labTests): LabTestCategory
    {
        $model = LabTestCategoryEloquent::with(['name.langs', 'labTests.name.langs', 'labTests.description.langs'])->find($labTest->getId()->toString());
        $model->labTests()->detach();
        foreach ($labTests as $labTestId) {
            $model->labTests()->attach($labTestId);
        }
        $model->load(['labTests.name.langs', 'labTests.description.langs']);
        return LabTestCategoryMapper::fromDatabase($model->toArray());
    }

    public function softDelete(string $id): void
    {
        $model = LabTestCategoryEloquent::findOrFail($id);
        $model->deleted = true;
        $model->save();
    }
}
