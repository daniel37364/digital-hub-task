<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\UseCases;

use Modules\Common\Application\Exceptions\ModelNotFoundException;
use Modules\LabTest\Domain\Models\LabTest;
use Modules\LabTest\Domain\Repositories\LabTestRepositoryInterface;

class FindByIdLabTestUseCase
{
    public function __construct(
        private readonly LabTestRepositoryInterface $repository
    ) {}

    public function execute(string $id): ?LabTest
    {
        $model = $this->repository->findById($id);
        if (!$model) {
            throw new ModelNotFoundException('LabTest', $id);
        }
        return $model;
    }
}
