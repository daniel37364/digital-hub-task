<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\UseCases;

use Illuminate\Support\Facades\DB;
use Modules\Common\Domain\Repositories\LangSetRepositoryInterface;
use Modules\LabTest\Domain\Repositories\LabTestRepositoryInterface;

class DestroyLabTestUseCase
{
    public function __construct(
        private readonly LabTestRepositoryInterface $labTestRepository,
        private readonly LangSetRepositoryInterface $langSetRepository
    ) {}

    public function execute(string $id): void
    {
        DB::beginTransaction();
        $labTest = $this->labTestRepository->softDelete($id);
        DB::commit();
    }
}
