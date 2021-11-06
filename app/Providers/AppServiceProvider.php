<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Where like macro
        Builder::macro('whereLike', function(string $attribute, string $searchTerm) {
            return $this->where(DB::raw('lower('.$attribute.')'), 'LIKE', '%'.mb_strtolower($searchTerm).'%');
        });

        // or Where like macro
        Builder::macro('orWhereLike', function(string $attribute, string $searchTerm) {
            return $this->orWhere(DB::raw('lower('.$attribute.')'), 'LIKE', '%'.mb_strtolower($searchTerm).'%');
        });

        Factory::guessFactoryNamesUsing(function (string $modelName) {
            return 'Modules\\Module\\Database\\Factories\\' . class_basename($modelName) . 'Factory';
        });
    }
}
