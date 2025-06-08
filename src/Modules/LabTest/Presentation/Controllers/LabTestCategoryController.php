<?php

declare(strict_types=1);

namespace Modules\LabTest\Presentation\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Common\Services\ApiResponseFormatter;
use Modules\LabTest\Application\Mappers\LabTestCategoryMapper;
use Modules\LabTest\Application\Mappers\LabTestCategoryUpdateMapper;
use Modules\LabTest\Application\UseCases\IndexLabTestCategoryUseCase;
use Modules\LabTest\Application\UseCases\StoreLabTestCategoryUseCase;
use Modules\LabTest\Presentation\Requests\LabTestCategoryShowRequest;
use Modules\LabTest\Presentation\Requests\LabTestCategoryIndexRequest;
use Modules\LabTest\Presentation\Requests\LabTestCategoryStoreRequest;
use Modules\LabTest\Application\Mappers\FilterLabTestCategoryDtoMapper;
use Modules\LabTest\Application\UseCases\DestroyLabTestCategoryUseCase;
use Modules\LabTest\Presentation\Requests\LabTestCategoryUpdateRequest;
use Modules\LabTest\Application\UseCases\FindByIdLabTestCategoryUseCase;
use Modules\LabTest\Application\UseCases\UpdateLabTestCategoryUseCase;
use Modules\LabTest\Presentation\Requests\LabTestCategoryDestroyRequest;

class LabTestCategoryController
{
    public function __construct(
        private readonly IndexLabTestCategoryUseCase $labTestIndexUseCase,
        private readonly FindByIdLabTestCategoryUseCase $findByIdLabTestCategoryUseCase,
        private readonly StoreLabTestCategoryUseCase $createLabTestUseCase,
        private readonly UpdateLabTestCategoryUseCase $updateLabTestUseCase,
        private readonly DestroyLabTestCategoryUseCase $destroyLabTestUseCase
    ) {}

    public function index(LabTestCategoryIndexRequest $request)
    {
        $filters = FilterLabTestCategoryDtoMapper::fromArray($request->validated());
        $labTestCategories = $this->labTestIndexUseCase->execute($filters);
        return ApiResponseFormatter::success(
            LabTestCategoryMapper::toResponseDtos($labTestCategories)
        );
    }

    public function show(LabTestCategoryShowRequest $request)
    {
        $labTestCategory = $this->findByIdLabTestCategoryUseCase->execute($request->id);
        return ApiResponseFormatter::success(
            LabTestCategoryMapper::toResponseDto($labTestCategory)
        );
    }

    public function store(LabTestCategoryStoreRequest $request)
    {
        $labTestCategory = LabTestCategoryMapper::fromArray($request->validated());
        $labTestCategory = $this->createLabTestUseCase->execute($labTestCategory);
        return ApiResponseFormatter::success(LabTestCategoryMapper::toResponseDto($labTestCategory), 'Success', 201);
    }

    public function update(LabTestCategoryUpdateRequest $request)
    {
        $labTestCategory = LabTestCategoryUpdateMapper::fromArray($request->validated());
        $labTestCategory = $this->updateLabTestUseCase->execute($labTestCategory);
        return ApiResponseFormatter::success(LabTestCategoryMapper::toResponseDto($labTestCategory), 'Success', 200);
    }

    public function destroy(LabTestCategoryDestroyRequest $request)
    {
        $this->destroyLabTestUseCase->execute($request->id);
        return ApiResponseFormatter::success(null, 'Lab Test Category deleted successfully', 200);
    }
}
