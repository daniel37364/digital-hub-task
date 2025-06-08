<?php

declare(strict_types=1);

namespace Modules\LabTest\Application\UseCases;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\DB;
use Modules\Common\Domain\Models\LangSet;
use Modules\LabTest\Domain\Models\LabTest;
use Modules\LabTest\Application\DTOs\LabTestDto;
use Modules\Common\Domain\Factories\LangSetFactory;
use Modules\Common\Application\Mappers\LangSetMapper;
use Modules\Common\Domain\Collections\LangCollection;
use Modules\Common\Domain\Repositories\LangSetRepositoryInterface;
use Modules\Common\Infrastructure\Repositories\LangSetRepository;
use Modules\LabTest\Domain\Factories\LabTestFactory;
use Modules\LabTest\Domain\Repositories\LabTestRepositoryInterface;

class CreateLabTestUseCase
{
    public function __construct(
        private LabTestRepositoryInterface $labTestRepository,
        private readonly LangSetRepositoryInterface $langSetRepository
    ) {}

    public function execute(LabTestDto $labTestDto): LabTest
    {
        try {
            DB::beginTransaction();
            // Creating langs
            $labTest = LabTestFactory::create([
                'name' => $labTestDto->name,
                'description' => $labTestDto->description,
                'code' => $labTestDto->code,
                'codeIcd' => $labTestDto->code_icd,
            ]);

            $this->langSetRepository->save($labTest->getNameLangSet());
            $this->langSetRepository->save($labTest->getDescriptionLangSet());

            $labtest = $this->labTestRepository->save($labTest);
            DB::commit();
            return $labtest;
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
