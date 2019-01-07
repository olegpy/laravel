<?php

namespace App\Providers;

use App\Http\Services\Contracts\ProposalServiceContract;
use App\Http\Services\Contracts\StorageServiceContract;
use App\Http\Services\Contracts\UserServiceContract;
use App\Http\Services\ProposalService;
use App\Http\Services\StorageService;
use App\Http\Services\UserService;
use App\Repositories\Contracts\ProposalRepositoryContract;
use App\Repositories\Contracts\UserRepositoryContract;
use App\Repositories\ProposalRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /**
         * List Registered Repository interfaces to the Repositories
         */
        $this->app->bind(UserRepositoryContract::class, UserRepository::class);
        $this->app->bind(ProposalRepositoryContract::class, ProposalRepository::class);

        /**
         * List Binded contracts interfaces to the services
         */
        $this->app->bind(UserServiceContract::class, UserService::class);
        $this->app->bind(ProposalServiceContract::class, ProposalService::class);

        $this->app->bind(StorageServiceContract::class, StorageService::class);
    }
}
