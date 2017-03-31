<?php

namespace KS\Aras;

use Illuminate\Support\ServiceProvider;

class ArasServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('aras', function(){
          return new Aras(config('app.aras'));
        });
    }
}
