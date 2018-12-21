<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Upload\Upload;

class UploadProvider extends ServiceProvider
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

        //bind 返回类的实例
//        $this->app->bind(Logic::class, function($app){
//            return new Logic(config('logconfig.logDriver'));
//        });
        //singleton 返回已存在的实例
        $this->app->singLeton(Upload::class, function($app){
            return new Upload();
        });
    }
}
