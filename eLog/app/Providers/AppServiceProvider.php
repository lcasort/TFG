<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\MoodRepository;
use App\Services\DateService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Repositories
        $this->app->bind(MoodRepository::class, function ($app) {
            return new MoodRepository();
        });

        // Services
        $this->app->bind(DateService::class, function ($app) {
            return new DateService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
