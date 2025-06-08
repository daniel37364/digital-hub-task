<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\UseCases;

use Modules\LabTest\Domain\Models\LabTestCategory;
use Modules\LabTest\Domain\Repositories\LabTestCategoryRepositoryInterface;

class FindByIdLabTestCategoryUseCase
{
    public function __construct(private LabTestCategoryRepositoryInterface $repository) {}

    public function execute(string $id): ?LabTestCategory
    {
        return $this->repository->findById($id);
    }
}
