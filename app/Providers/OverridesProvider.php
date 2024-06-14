<?php

namespace App\Providers;

use App\Overrides\FilamentFabricatorManager;
use App\Services\PageRoutesService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class OverridesProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->scoped(FilamentFabricatorManager::ID, FilamentFabricatorManager::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Route::bind(
            'filamentFabricatorPage',
            function ($value) {
                $routesService = resolve(PageRoutesService::class);

                return $routesService->findPageOrFail($value);
            }
        );
    }
}
