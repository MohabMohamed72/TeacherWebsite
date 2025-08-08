<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class HelloProvider extends ServiceProvider
{
    /**
     * Register services.*/
    public function boot(): void
    {
        $this->mapApiRoutes();
    }

    /**
     * Register API routes.
     */
    protected function mapApiRoutes(): void
    {
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('routes/api.php'));
    }
}
