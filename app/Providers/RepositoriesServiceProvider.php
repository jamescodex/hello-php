<?php

namespace App\Providers;

use App\Repositories\AdminRepository;
use App\Repositories\StaffRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\AdminRepositoryInterface;
use App\Repositories\StaffRepositoryInterface;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(StaffRepositoryInterface::class, StaffRepository::class);
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
    }
}
