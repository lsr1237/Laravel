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
        Route::get('index/{id}', 'IndexController@index');
        Route::get('test', 'IndexController@test');
    });
});

