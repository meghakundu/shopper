<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SpellsService;

class GumroadServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * 
     */
    public function boot()
    {
        //
    }
    public function register()
    {
        //
        $this->app->bind('App\Services\SpellsService', function ($app) {
            $services_gumroad = new SpellsService();
            //echo "123";
          return $services_gumroad;
        });
       
    }

    /**
     * Bootstrap services.
     *
     * 
     */
    
}
