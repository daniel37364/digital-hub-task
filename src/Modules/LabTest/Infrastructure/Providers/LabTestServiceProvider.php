<?php

declare(strict_types=1);

namespace Modules\LabTest\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\LabTest\Application\UseCases\CreateLabTestUseCase;
use Modules\LabTest\Domain\Repositories\LabTestCategoryRepositoryInterface;
use Modules\LabTest\Infrastructure\Repositories\LabTestRepository;
use Modules\LabTest\Domain\Repositories\LabTestRepositoryInterface;
use Modules\LabTest\Infrastructure\Repositories\LabTestCategoryRepository;

class LabTestServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(LabTestRepositoryInterface::class, LabTestRepository::class);
        $this->app->bind(LabTestCategoryRepositoryInterface::class, LabTestCategoryRepository::class);

        $this->app->bind(CreateLabTestUseCase::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Additional boot logic if needed
    }
}
