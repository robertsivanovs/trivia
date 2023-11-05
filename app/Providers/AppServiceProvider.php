<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\DataFetcherService;
use App\Services\ValidatorService;
use App\Contracts\DataFetcherServiceInterface;
use App\Contracts\ValidatorServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(DataFetcherServiceInterface::class, DataFetcherService::class);
        $this->app->bind(ValidatorServiceInterface::class, ValidatorService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
