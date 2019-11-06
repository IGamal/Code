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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post/{id}',['as' => 'home.post', 'uses' => 'AdminPostsController@post']);

Route::group(['middleware' => 'admin'], function ()
{
    Route::get('/admin', function () {return view('admin.index');});

    Route::resource('admin/users','AdminUsersController');
    Route::delete('/delete/user','AdminUsersController@delete');

    Route::resource('admin/posts','AdminPostsController');
    Route::delete('/delete/post','AdminPostsController@delete');

    Route::resource('/admin/categories','AdminCategoriesController');
    Route::delete('/delete/categories','AdminCategoriesController@delete');

});

Route::group(['middleware' => 'auth'],function ()
{
    Route::resource('admin/comments','PostCommentsController');
    Route::delete('/delete/comment','PostCommentsController@delete');

    Route::resource('admin/comments/replies','CommentRepliesController');
    Route::delete('/delete/comments/replies','CommentRepliesController@delete');

});
