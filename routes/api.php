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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth'
], function(){
    Route::post('login', 'App\Http\Controllers\Api\Auth\JWTAuthController@login')->name('jwt.login');
    Route::post('register', 'App\Http\Controllers\Api\Auth\JWTAuthController@register')->name('jwt.register');

    Route::post('me', 'App\Http\Controllers\Api\Auth\JWTAuthController@me')->name('jwt.me'); //현재 접속자 가져옴
    Route::post('refresh', 'App\Http\Controllers\Api\Auth\JWTAuthController@refresh')->name('jwt.refresh'); //현재 토큰 갱신
    Route::post('logout', 'App\Http\Controllers\Api\Auth\JWTAuthController@logout')->name('jwt.logout');

    Route::post('adminList', 'App\Http\Controllers\Api\Auth\JWTAuthController@adminList')->name('jwt.adminList');
});

