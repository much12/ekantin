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
    Route::get('user', 'UserController@index');
    Route::get('user/add', 'UserController@modal_user_add');
    Route::post('user/add/process', 'UserController@process_add_user');
    Route::post('user/edit', 'UserController@modal_user_edit');
    Route::post('user/edit/process', 'UserController@process_edit_user');
    Route::post('user/delete', 'UserController@process_delete_user');
});
