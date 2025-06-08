<?php

declare(strict_types=1);

namespace Modules\LabTest\Presentation\Controllers;

use Illuminate\Http\Request;
use Modules\LabTest\Application\DTOs\LabTestDto;
use Modules\Common\Services\ApiResponseFormatter;
use Modules\LabTest\Application\DTOs\LabTestUpdateDto;
use Modules\LabTest\Application\Mappers\LabTestMapper;
use Modules\LabTest\Application\DTOs\LabTestCategoryDto;
use Modules\LabTest\Presentation\Resources\LabTestResource;
use Modules\LabTest\Application\Mappers\LabTestUpdateMapper;
use Modules\LabTest\Application\UseCases\LabTestIndexUseCase;
use Modules\LabTest\Presentation\Requests\LabTestShowRequest;
use Modules\LabTest\Application\UseCases\CreateLabTestUseCase;
use Modules\LabTest\Application\UseCases\UpdateLabTestUseCase;
use Modules\LabTest\Presentation\Requests\LabTestIndexRequest;
use Modules\LabTest\Presentation\Requests\LabTestStoreRequest;
use Modules\LabTest\Application\Mappers\FilterLabTestDtoMapper;
use Modules\LabTest\Application\UseCases\DestroyLabTestUseCase;
use Modules\LabTest\Presentation\Requests\LabTestUpdateRequest;
use Modules\LabTest\Application\UseCases\FindByIdLabTestUseCase;
use Modules\LabTest\Presentation\Requests\LabTestDestroyRequest;
use Modules\LabTest\Domain\Repositories\LabTestRepositoryInterface;

class LabTestController
{
    public function __construct(
        private readonly CreateLabTestUseCase $createLabTestUseCase,
        private readonly LabTestIndexUseCase $labTestIndexUseCase,
        private readonly FindByIdLabTestUseCase $findByIdLabTestUseCase,
        private readonly UpdateLabTestUseCase $updateLabTestUseCase,
        private readonly DestroyLabTestUseCase $destroyLabTestUseCase
    ) {}

    public function index(LabTestIndexRequest $request)
    {
        $filters = FilterLabTestDtoMapper::fromArray($request->validated());
        $labTests = $this->labTestIndexUseCase->execute($filters);
        return ApiResponseFormatter::success(
            LabTestMapper::toResponseDtos($labTests)
        );
    }

    public function show(LabTestShowRequest $request)
    {
        $labTest = $this->findByIdLabTestUseCase->execute($request->id);
        return ApiResponseFormatter::success(
            LabTestMapper::toResponseDto($labTest)
        );
    }

    public function store(LabTestStoreRequest $request)
    {
        $labTest = LabTestMapper::fromArray($request->validated());
        $labTest = $this->createLabTestUseCase->execute($labTest);
        return ApiResponseFormatter::success(LabTestMapper::toResponseDto($labTest), 'Success', 201);
    }

    public function update(LabTestUpdateRequest $request)
    {
        $labTestUpdateDto = LabTestUpdateMapper::fromArray($request->validated());
        $labTest = $this->updateLabTestUseCase->execute($labTestUpdateDto);
        return ApiResponseFormatter::success(LabTestMapper::toResponseDto($labTest), 'Success', 200);
    }

    public function destroy(LabTestDestroyRequest $request)
    {
        $this->destroyLabTestUseCase->execute($request->id);
        return ApiResponseFormatter::success(null, 'Lab test deleted successfully', 200);
    }
}
