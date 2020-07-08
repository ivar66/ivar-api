<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['namespace' => 'Api'], function () {
    # 文章内容接口
    Route::group(['prefix' => 'article'],function (){
        # 文章列表
        Route::get('/list','ArticleController@list');
        # 文章详情
        Route::get('/{id}/detail','ArticleController@detail')->where('id','[0-9]+');
    });

    Route::group(['prefix' => 'member'],function (){
        # 用户登录
        Route::post('/login','UserController@login');
        # 用户登出
        Route::post('/logout','UserController@logout');
        # 获取用户信息
        Route::get('/info','UserController@info');

    });

});
