<?php

use Illuminate\Support\Facades\Route;
use Modules\LabTest\Presentation\Controllers\LabTestCategoryController;
use Modules\LabTest\Presentation\Controllers\LabTestController;

Route::prefix('lab-tests')->group(function () {
    Route::get('/', [LabTestController::class, 'index']);
    Route::get('/{id}', [LabTestController::class, 'show']);
    Route::post('/', [LabTestController::class, 'store']);
    Route::put('/{id}', [LabTestController::class, 'update']);
    Route::delete('/{id}', [LabTestController::class, 'destroy']);
});

Route::prefix('lab-test-categories')->group(function () {
    Route::get('/', [LabTestCategoryController::class, 'index']);
    Route::get('/{id}', [LabTestCategoryController::class, 'show']);
    Route::post('/', [LabTestCategoryController::class, 'store']);
    Route::put('/{id}', [LabTestCategoryController::class, 'update']);
    Route::delete('/{id}', [LabTestCategoryController::class, 'destroy']);
});
