<?php

namespace App\Providers;

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
        $this->app->bind(\Modules\Movie\Repositories\MovieRepository::class,
            \Modules\Movie\Repositories\Eloquent\MovieRepositoryEloquent::class);

        $this->app->bind(\Modules\Movie\Repositories\CategoryRepository::class,
            \Modules\Movie\Repositories\Eloquent\CategoryRepositoryEloquent::class);

        //:end-bindings:
    }
}
