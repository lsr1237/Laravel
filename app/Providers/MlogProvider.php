<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Logic\Logic;

class MlogProvider extends ServiceProvider
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
        $this->app->singLeton(Logic::class, function($app){
           return new Logic(config('logconfig.logDriver'));
        });
    }
}
