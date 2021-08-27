<?php

namespace App\Providers;

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
        foreach(Glob(App_path('Helpers/*.php')) As $Filename){
            Require_once $Filename;
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        config(["app.locale" => "id"]);
        \Carbon\Carbon::setLocale("id");
    }
}
