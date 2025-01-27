<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
class AppServiceProvider extends ServiceProvider
{   
    protected $namespace = 'App\Http\Controllers';
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    }
    
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
