<?php

use Illuminate\Support\Facades\Route;

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

Route::post('register','AuthController@register');
Route::post('api/login','AuthController@login');
Route::get('test1','AuthController@test1');
Route::prefix('admin')->middleware(['auth:api'])->group(function(){
    Route::get('logout','AuthController@logout');
    Route::get('me','AuthController@me');
    Route::get('refresh','AuthController@refresh');
    Route::get('test','AuthController@test');
    Route::get('logout','AuthController@logout');
});
