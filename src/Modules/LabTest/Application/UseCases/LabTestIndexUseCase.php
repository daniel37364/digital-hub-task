<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\UseCases;

use Modules\LabTest\Application\DTOs\FilterLabTestDto;
use Modules\LabTest\Domain\Collections\LabTestCollection;
use Modules\LabTest\Domain\Repositories\LabTestRepositoryInterface;

class LabTestIndexUseCase
{
    public function __construct(private LabTestRepositoryInterface $repository) {}

    public function execute(FilterLabTestDto $filterDto): LabTestCollection
    {
        return $this->repository->filterLabTests($filterDto);
    }
}
