<?php

namespace App\Providers;

use App\Repositories\Eloquent\ExpenseRepository;
use App\Repositories\ExpenseRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(ExpenseRepositoryInterface::class ,ExpenseRepository::class);
    }
}
