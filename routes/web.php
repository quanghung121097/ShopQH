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

Route::group([
  'namespace' => 'admin',
  'prefix' => 'admin',
  'middleware' => 'auth'
], function () {
  Route::get('/dashboard', 'ControllerDashboard@index')->name('admin.dashboard');
  Route::group(['prefix' => 'users'], function () {
    Route::get('/', 'UserController@index')->name('admin.user.index');
    Route::get('/create', 'UserController@create')->name('admin.user.create');
    Route::post('/store', 'UserController@store')->name('admin.user.store');
    Route::get('/edit/{id}', 'UserController@edit')->name('admin.user.edit');
    Route::post('/update', 'UserController@update')->name('admin.user.update');
    Route::post('/del', 'UserController@deleteAT')->name('admin.user.del');
    Route::delete('/destroy{id}', 'UserController@destroy')->name('admin.user.destroy');
    Route::get('/{user_id}', 'UserController@show')->name('admin.user.show');
  });
  Route::group(['prefix' => 'categories'], function () {
    Route::get('/', 'CategoryController@index')->name('admin.category.index');
    Route::get('/create', 'CategoryController@create')->name('admin.category.create');
    Route::post('/store', 'CategoryController@store')->name('admin.category.store');
    Route::get('/edit/{id}', 'CategoryController@edit')->name('admin.category.edit');
    Route::post('/update', 'CategoryController@update')->name('admin.category.update');
    Route::post('/del', 'CategoryController@deleteAT')->name('admin.category.del');
    Route::delete('/destroy{id}', 'CategoryController@destroy')->name('admin.category.destroy');
    Route::get('/{id}', 'CategoryController@show')->name('admin.category.show');
  });
});
Auth::routes();
