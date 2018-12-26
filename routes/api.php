<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'api'], function ($router) {

    //注册，登录
    $router->post('/register', 'RegisteredController@register')->name('api.register');
    $router->post('/login', 'LoginController@login')->name('api.login');

    //登录操作之后才能执行的操作
    $router->group(['middleware' => 'login.token'], function ($router) {

    });

});
