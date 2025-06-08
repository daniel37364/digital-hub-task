<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\UseCases;

use Illuminate\Support\Facades\DB;
use Modules\LabTest\Domain\Models\LabTestCategory;
use Modules\LabTest\Domain\Repositories\LabTestCategoryRepositoryInterface;
use Modules\Common\Domain\Repositories\LangSetRepositoryInterface;
use Modules\Common\Application\Mappers\LangSetMapper;
use Modules\LabTest\Application\DTOs\LabTestCategoryDto;
use Modules\LabTest\Domain\Factories\LabTestCategoryFactory;

class StoreLabTestCategoryUseCase
{
    public function __construct(
        private LabTestCategoryRepositoryInterface $labTestCategoryRepository,
        private LangSetRepositoryInterface $langSetRepository
    ) {}

    public function execute(LabTestCategoryDto $labTestCategoryDto): LabTestCategory
    {
        try {
            DB::beginTransaction();
            // Creating langs
            $labTest = LabTestCategoryFactory::create([
                'name' => $labTestCategoryDto->name,
                'public' => $labTestCategoryDto->public,
                'ord' => $labTestCategoryDto->ord,
            ]);

            $this->langSetRepository->save($labTest->getNameLangSet());

            $labtest = $this->labTestCategoryRepository->save($labTest);
            DB::commit();
            return $labtest;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
