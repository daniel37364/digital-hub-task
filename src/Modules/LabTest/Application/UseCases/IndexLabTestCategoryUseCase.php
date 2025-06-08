<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\UseCases;

use Modules\LabTest\Application\DTOs\FilterLabTestCategoryDto;
use Modules\LabTest\Domain\Collections\LabTestCategoryCollection;
use Modules\LabTest\Domain\Repositories\LabTestCategoryRepositoryInterface;

class IndexLabTestCategoryUseCase
{
    public function __construct(private LabTestCategoryRepositoryInterface $repository) {}

    public function execute(FilterLabTestCategoryDto $filterDto): LabTestCategoryCollection
    {
        return $this->repository->filterLabTestCategories($filterDto);
    }
}
