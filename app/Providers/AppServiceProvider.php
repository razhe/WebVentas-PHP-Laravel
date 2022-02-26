<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//paginacion
use Illuminate\Pagination\Paginator;

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
        //para que use bootstrap en la paginación
        Paginator::useBootstrap();
    }
}
