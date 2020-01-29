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

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::get('/404', function () {
    return view('errors.404');
})->name('404');

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin');

//recoure route for admin/user
Route::group(['middleware' => 'web'], function () {



    Route::group(['middleware' => 'admin'], function () {

        Route::resource('/admin/users', 'AdminUsersController');
        Route::resource('/admin/posts', 'AdminPostsController');
        Route::resource('/admin/category', 'AdminCategoriesController');
    });
});
