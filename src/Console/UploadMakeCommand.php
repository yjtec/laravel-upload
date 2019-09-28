<?php

namespace Yjtec\Upload\Console;

use Illuminate\Console\Command;
use Illuminate\Console\DetectsApplicationNamespace;

class UploadMakeCommand extends Command
{
    use DetectsApplicationNamespace;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'make:upload {way} ';
    protected $signature = 'make:upload ';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold basic upload routes';

    public function handle()
    {
        $way  = $this->choice('which way you choise?',['web','api','rpc']);
        $this->$way();
        //call_user_method_array($way, $this);
        // if($way == 'web'){

        // }
        // file_put_contents(
        //     base_path('routes/web.php'),
        //     file_get_contents(__DIR__.'/stubs/make/routes.stub'),
        //     FILE_APPEND
        // );
    }

    public function web(){
        file_put_contents(
            base_path('routes/web.php'),
            file_get_contents(__DIR__.'/stubs/make/routes.stub'),
            FILE_APPEND
        );
    }
    public function api(){
        file_put_contents(
            base_path('routes/api.php'),
            file_get_contents(__DIR__.'/stubs/make/routes.stub'),
            FILE_APPEND
        );
    }
public function rpc(){
        file_put_contents(
            base_path('routes/rpc.php'),
            file_get_contents(__DIR__.'/stubs/make/rpc.stub'),
            FILE_APPEND
        );
    }    
}
