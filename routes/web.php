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

Route::group(['namespace' => 'Auth'], function () {
    Route::get('/', 'LoginController@showLoginForm')->name('login');
    Route::post('/', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');
});

Route::group(['namespace' => 'User', 'middleware' => ['ifguest', 'personal.account']], function () {
    Route::get('/account', 'WorkerCreateController')->name('worker.create');
    Route::post('/account', 'WorkerStoreController')->name('worker.store');

    Route::get('/account/{worker}/edit', 'WorkerEditController')->name('worker.edit');
    Route::patch('/account/{worker}', 'WorkerUpdateController')->name('worker.update');
    Route::delete('/account/{worker}', 'WorkerDestroyController')->name('worker.delete');
});

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['ifguest', 'admin', 'personal.account']], function () {
    Route::get('/account', 'UserCreateController')->name('user.create');
    Route::post('/account', 'UserStoreController')->name('user.store');

    Route::get('/account/{user}/edit', 'UserEditController')->name('user.edit');
    Route::patch('/account/{user}', 'UserUpdateController')->name('user.update');
    Route::delete('/account/{user}', 'UserDestroyController')->name('user.delete');

    Route::get('/locations', 'LocationsController')->name('locations.create');
    Route::get('/locations/{location}/edit/addchild', 'LocationsGrAddController')->name('locations.gr.create');
    Route::get('/locations/{location}/editchild', 'LocationsGrEditController')->name('locations.gr.edit');
    Route::post('/locations/{parent_loc}', 'LocationsStoreController')->name('locations.store');

    Route::get('/locations/{location}/edit', 'LocationsEditController')->name('locations.edit');
    Route::patch('/locations/{location}', 'LocationsUpdateController')->name('locations.update');
    Route::delete('/locations/{location}', 'LocationsDestroyController')->name('locations.delete');

    Route::get('/toworkers/{user}/edit', 'ToWorkersController')->name('toworkers.edit');
    Route::patch('/toworkers/{user}', 'ToWorkersUpdateController')->name('toworkers.update');

});

//Route::group(['namespace' => 'Auth', 'prefix' => 'admin', 'middleware' => ['ifguest', 'admin']], function () {
   // Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
   // Route::post('register', 'RegisterController@register');
    // // Password Reset Routes...
    // Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm');
    // Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
    // Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm');
    // Route::post('password/reset', 'ResetPasswordController@reset');
//});

Route::get('/test', 'TestController')->name('test');
