<?php

declare(strict_types=1);

namespace Modules\LabTest\Domain\Repositories;

use Modules\LabTest\Domain\Models\LabTestCategory;
use Modules\LabTest\Application\DTOs\FilterLabTestCategoryDto;
use Modules\LabTest\Domain\Collections\LabTestCategoryCollection;

interface LabTestCategoryRepositoryInterface
{
    public function filterLabTestCategories(FilterLabTestCategoryDto $filterDto): LabTestCategoryCollection;
    public function findById(string $id): ?LabTestCategory;
    public function save(LabTestCategory $labTestCategory): LabTestCategory;
    // public function delete(string $id): void;
}
