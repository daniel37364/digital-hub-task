<?php

namespace Modules\LabTest\Domain\Repositories;

use Modules\LabTest\Domain\Models\LabTest;
use Modules\LabTest\Application\DTOs\LabTestDto;
use Modules\LabTest\Application\DTOs\FilterLabTestDto;
use Modules\LabTest\Domain\Collections\LabTestCollection;

interface LabTestRepositoryInterface
{
    public function filterLabTests(FilterLabTestDto $filterDto): LabTestCollection;
    public function findById(string $id): ?LabTest;
    public function save(LabTest $labTest): LabTest;
    public function delete(string $id): void;
    public function updateCategories(LabTest $labTest, array $categoryIds): LabTest;
}
