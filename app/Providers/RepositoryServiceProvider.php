<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\Api\UserRepository;
use App\Repository\Api\RepositoryInterface\UserRepositoryInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
