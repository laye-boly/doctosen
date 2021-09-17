<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\SearchRvService;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *S
     * @return void
     */
    public function register()
    {
        $this->app->bind(SearchRvService::class, function ($app) {
            return new SearchRvService(null,null, null, null, null, null, null, null);
        });
        // $this->app->when(SearchService::class)
        //   ->needs('$name')
        //   ->give(null)
        //   ;
        // $this->app->when(SearchService::class)
        //   ->needs('$adress')
        //   ->give(null)
        //   ;

        // $this->app->when(SearchService::class)
        //   ->needs('$title')
        //   ->give(null);
        
        // $this->app->when(SearchService::class)
        //   ->needs('$vaccin')
        //   ->give(null);

        // $this->app->when(SearchService::class)
        //   ->needs('$table')
        //   ->give(null);

        

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
