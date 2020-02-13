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



//recoure route for admin/user
Route::group(['middleware' => 'web'], function () {

    Route::get('/post/{id}', 'AdminPostsController@post')->name('home.post');



    Route::group(['middleware' => 'admin'], function () {

        Route::get('/admin', 'AdminController@index')->name('admin');

        Route::resource('/admin/users', 'AdminUsersController');
        Route::resource('/admin/posts', 'AdminPostsController');
        Route::resource('/admin/category', 'AdminCategoriesController');
        // Route::resource('/admin/category', 'AdminCategoriesController');
        Route::resource('/admin/media', 'AdminMediasController');
        Route::delete('/admin/delete/media', 'AdminMediasController@deleteMedia')->name('deleteMedia');

        Route::resource('/admin/comments', 'PostCommentsController');
        Route::resource('/admin/comment/replies', 'CommentRepliesController');
    });

    Route::group(['middleware' => 'auth'], function () {


        Route::post('/comment/replies', 'CommentRepliesController@createReplie')->name("createReplie");
    });
});
