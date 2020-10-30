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
    return view('welcome',['items' => 'id']);
});

Route::get('/about','NewsItemController@show')->name('about');
Route::get( '/','NewsItemController@index')->name('index');
Route::post('/', 'JsonController@store');
Route::get('posts/create','NewsItemController@create')->name('posts.create')->middleware('auth');
Route::post('posts/save','NewsItemController@save')->name('posts.save')->middleware('auth');
Route::get('posts/{id}','NewsItemController@show')->name('news.show');
Route::get('/filter','NewsItemController@filter')->name('posts.filter');

Route::get("/account",'AccountController@index')->name('user.account')->middleware('auth');
Route::get('account/posts','AccountController@posts')->name('user.posts')->middleware('auth');
Route::get('account/settings','AccountController@settings')->name('user.settings')->middleware('auth');
Route::get('account/privacy','AccountController@privacy')->name('user.privacy')->middleware('auth');
Route::post('account/posts/save','AccountController@updatePost')->name('user.updatePost')->middleware('auth');
Route::get('account/posts/{id}','AccountController@mutatePost')->name('user.mutatePost')->middleware('auth');

Auth::routes();

Route::post('delete-post','JsonController@deletePost');
Route::post('json-request', 'JsonController@store');
Route::post('set-active', 'JsonController@active');

Route::group(['middleware' => 'is.admin'], function () {
    Route::get("/admin",'AccountController@index')->name('user.account');
});