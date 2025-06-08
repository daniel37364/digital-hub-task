<?php

declare(strict_types=1);

namespace Modules\Common\Infrastructure\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Common\Domain\Repositories\LangSetRepositoryInterface;
use Modules\Common\Infrastructure\Repositories\LangSetRepository;

class CommonServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(LangSetRepositoryInterface::class, LangSetRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Additional boot logic if needed
    }
}
