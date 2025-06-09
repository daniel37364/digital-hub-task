<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\UseCases;

use Illuminate\Support\Facades\DB;
use Modules\LabTest\Domain\Repositories\LabTestCategoryRepositoryInterface;
use Modules\Common\Domain\Repositories\LangSetRepositoryInterface;

class DestroyLabTestCategoryUseCase
{
    public function __construct(
        private LabTestCategoryRepositoryInterface $labTestCategoryRepository,
        private LangSetRepositoryInterface $langSetRepository
    ) {}

    public function execute(string $id): void
    {
        DB::beginTransaction();
        $labTestCategory = $this->labTestCategoryRepository->softDelete($id);
        DB::commit();
    }
}
