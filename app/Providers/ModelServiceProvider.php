<?php

namespace App\Providers;

use App\Http\Service\AuthService;
use App\Http\Service\Impl\AuthServiceImpl;
use Illuminate\Support\ServiceProvider;

class ModelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Article
        $this->app->bind(AuthService::class, AuthServiceImpl::class);
    }
}
