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

Route::group([], function ($router) {

    //测试路由,用于测试使用(正式环境请注释)
    $router->get('test', 'TestController@test');

    //Api模块
    $router->group(['namespace' => 'Api'], function ($router) {
        $router->post('/register', 'RegisteredController@register')->name('api.register');
        $router->post('/login', 'LoginController@login')->name('api.login');

        //登录操作之后才能执行的操作
        $router->group(['middleware' => 'login.token'], function ($router) {

        });
    });

});