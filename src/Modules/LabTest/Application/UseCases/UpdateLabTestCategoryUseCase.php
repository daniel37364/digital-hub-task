<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\UseCases;

use Illuminate\Support\Facades\DB;
use Modules\LabTest\Application\DTOs\LabTestCategoryUpdateDto;
use Modules\LabTest\Domain\Repositories\LabTestCategoryRepositoryInterface;
use Modules\Common\Domain\Repositories\LangSetRepositoryInterface;
use Modules\Common\Application\Mappers\LangSetMapper;
use Modules\LabTest\Domain\Models\LabTestCategory;

class UpdateLabTestCategoryUseCase
{
    public function __construct(
        private LabTestCategoryRepositoryInterface $labTestCategoryRepository,
        private LangSetRepositoryInterface $langSetRepository
    ) {}

    public function execute(LabTestCategoryUpdateDto $dto): LabTestCategory
    {
        try {
            DB::beginTransaction();

            $labTestCategory = $this->labTestCategoryRepository->findById($dto->id);

            if (!$labTestCategory) {
                throw new \Exception("LabTestCategory not found");
            }

            if ($dto->name) {
                $labTestCategory->getNameLangSet()->updateLangs($dto->name);
                $this->langSetRepository->save($labTestCategory->getNameLangSet());
            }


            if ($dto->public !== null) {
                $labTestCategory->updatePublic($dto->public);
            }

            if ($dto->ord !== null) {
                $labTestCategory->updateOrd($dto->ord);
            }
            if ($dto->labTests !== null) {
                $this->labTestCategoryRepository->updateLabTests($labTestCategory, $dto->labTests);
            }

            $labTestCategory = $this->labTestCategoryRepository->save($labTestCategory);

            DB::commit();
            return $labTestCategory;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
