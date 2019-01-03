<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/**
 * index 路由测试
 * 2018.12.17
 */
//Route::get('Index/Index/index','Index\IndexController@index');
//Route::get('Index/Index/test','Index\IndexController@test');

// group and prefix 使得路由更具层次
Route::group(['namespace'=>'Index', 'prefix'=>'Index'],function(){
    Route::group(['prefix'=>'Index'], function(){
        Route::get('index', 'IndexController@index')->middleware('login');
        Route::get('test', 'IndexController@test');
        Route::get('welcome','IndexController@welcome');
        Route::post('upload','IndexController@upload')->middleware('uploads');
    });
    Route::group(['prefix'=>'Redis'], function(){
        Route::get('test_redis','RedisController@test_redis');
    });
});
Route::group(['namespace'=>'Client','prefix'=>'Client'],function(){
    Route::group(['prefix'=>'Client'],function(){
       Route::post('bind','ClientController@bind_client_id');
       Route::post('unbind','ClientController@unbind_client_id');
    });
});
Route::group(['namespace'=>'Char','prefix'=>'Char'],function(){
    Route::group(['prefix'=>'Char'], function(){
        Route::get('char_window','CharController@char_window');
        Route::post('send_message','CharController@send_message');
    });
});
//Route::group(['namespace'=>'Boke','prefix'=>'Boke'],function(){
//    Route::group(['prefix'=>'Boke'],function(){
//        Route::get('index','BokeController@index');
//    });
//});
Route::get('Index/Index/test_middleware', 'Index\IndexController@test_middleware')->middleware('verification');
Route::get('Index/Index/login', 'Index\IndexController@login');
Route::get('boke', 'Boke\BokeController@index');
Route::post('Index/Index/login_in', 'Index\IndexController@login_in');

