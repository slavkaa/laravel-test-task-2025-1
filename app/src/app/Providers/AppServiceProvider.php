<?php

namespace App\Providers;

use App\Repositories\Game\GameResultsRepository;
use App\Repositories\Game\GameResultsRepositoryInterface;
use App\Repositories\Registration\RegistrationLinkRepository;
use App\Repositories\Registration\RegistrationLinkRepositoryInterface;
use App\Services\Game\GameService;
use App\Services\Game\GameServiceInterface;
use App\Services\Registration\RegistrationLinkManagementService;
use App\Services\Registration\RegistrationLinkManagementServiceInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            RegistrationLinkRepositoryInterface::class,
            RegistrationLinkRepository::class
        );

        $this->app->bind(
            RegistrationLinkManagementServiceInterface::class,
            RegistrationLinkManagementService::class
        );

        $this->app->bind(
            GameServiceInterface::class,
            GameService::class
        );

        $this->app->bind(
            GameResultsRepositoryInterface::class,
            GameResultsRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
