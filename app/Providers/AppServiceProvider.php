<?php

namespace App\Providers;

use ConsoleTVs\Charts\Classes\C3\Chart;
use Illuminate\Support\ServiceProvider;

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
     * @param Chart $charts
     * @return void
     */
    public function boot(Chart $charts)
    {

    }
}
