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
    return redirect('dashboard');
});

Route::get('login', 'LoginController@index');
Route::post('login/auth', 'LoginController@auth');
Route::get('logout', 'LoginController@logout');

Route::group(['middleware' => ['CekSession']], function () {
    Route::get('dashboard', 'DashboardController@index');
});
