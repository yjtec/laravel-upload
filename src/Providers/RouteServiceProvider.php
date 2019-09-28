<?php

namespace Yjtec\Upload\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'Yjtec\Upload\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        Route::bind('file',function($value){
            return \Yjtec\Upload\Models\File::where('key',$value)->first();
        });
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    
}
