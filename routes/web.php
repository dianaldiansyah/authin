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

Route::get('/','App\Http\Controllers\AuthinController@index');
Route::get('/login','App\Http\Controllers\AuthinController@login');
Route::get('/register','App\Http\Controllers\AuthinController@register');
Route::post('/validate-login','App\Http\Controllers\AuthinController@validateLogin');
Route::post('/validate-register','App\Http\Controllers\AuthinController@validateRegister');
