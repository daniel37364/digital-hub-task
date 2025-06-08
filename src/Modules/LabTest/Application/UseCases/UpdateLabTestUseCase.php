<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\UseCases;

use Illuminate\Support\Facades\DB;
use Modules\Common\Domain\Repositories\LangSetRepositoryInterface;
use Modules\LabTest\Application\DTOs\LabTestUpdateDto;
use Modules\LabTest\Domain\Repositories\LabTestRepositoryInterface;
use Modules\LabTest\Domain\Models\LabTest;

class UpdateLabTestUseCase
{
    public function __construct(
        private readonly LabTestRepositoryInterface $repository,
        private readonly LangSetRepositoryInterface $langSetRepository
    ) {}

    public function execute(LabTestUpdateDto $dto): LabTest
    {
        try {
            DB::beginTransaction();

            $labTest = $this->repository->findById($dto->id);

            if ($dto->code !== null) {
                $labTest->updateCode($dto->code);
            }
            if ($dto->codeIcd !== null) {
                $labTest->updateCodeIcd($dto->codeIcd);
            }
            if ($dto->public !== null) {
                $labTest->updatePublic($dto->public);
            }

            if ($dto->name) {
                $labTest->getNameLangSet()->updateLangs($dto->name);
                $this->langSetRepository->save($labTest->getNameLangSet());
            }

            if ($dto->description) {
                $labTest->getDescriptionLangSet()->updateLangs($dto->description);
                $this->langSetRepository->save($labTest->getDescriptionLangSet());
            }
            if ($dto->categories !== null) {
                $this->repository->updateCategories($labTest, $dto->categories);
            }


            $labTest = $this->repository->save($labTest);
            DB::commit();
            return $labTest;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
