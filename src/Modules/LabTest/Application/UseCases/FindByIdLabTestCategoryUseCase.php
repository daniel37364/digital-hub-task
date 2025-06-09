<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\UseCases;

use Modules\Common\Application\Exceptions\ModelNotFoundException;
use Modules\LabTest\Domain\Models\LabTestCategory;
use Modules\LabTest\Domain\Repositories\LabTestCategoryRepositoryInterface;

class FindByIdLabTestCategoryUseCase
{
    public function __construct(private LabTestCategoryRepositoryInterface $repository) {}

    public function execute(string $id): ?LabTestCategory
    {
        $model = $this->repository->findById($id);
        if (!$model) {
            throw new ModelNotFoundException('LabTestCategory', $id);
        }
        return $model;
    }
}
