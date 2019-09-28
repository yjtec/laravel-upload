<?php

namespace Yjtec\Upload\Providers;

use Illuminate\Support\ServiceProvider;

class UploadServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadCommands();
    }

    public function loadCommands(){
        $this->commands([
            \Yjtec\Upload\Console\UploadMakeCommand::class,
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config.php', 'upload'
        );
        $this->registerRule();
        $this->registerUpload();
    }

    public function registerRule(){
        $this->app->singleton('upload.rule', function ($app) {
            return new \Yjtec\Upload\Rule(config('upload'));
        });
    }

    public function registerUpload(){
        $this->app->singleton('upload',function($app){
            return new \Yjtec\Upload\Upload(config('upload'));
        });
    }


}
