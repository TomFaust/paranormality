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
Route::get('/filter','NewsItemController@filter')->name('posts.filter');


Auth::routes();

Route::group(['middleware'=>['auth']], function(){
    Route::get("/account",'AccountController@index')->name('user.account');
    Route::get('account/posts','AccountController@posts')->name('user.posts');
    Route::get('account/settings','AccountController@settings')->name('user.settings');
    Route::get('account/privacy','AccountController@privacy')->name('user.privacy');
    Route::post('account/posts/save','AccountController@updatePost')->name('user.updatePost');
    Route::get('account/posts/{id}','AccountController@mutatePost')->name('user.mutatePost');
    Route::get('posts/create','NewsItemController@create')->name('posts.create');
    Route::post('posts/save','NewsItemController@save')->name('posts.save');

    Route::post('delete-post','JsonController@deletePost');
    Route::post('json-request', 'JsonController@store');
    Route::post('set-active', 'JsonController@active');
});

Route::get('posts/{id}','NewsItemController@show')->name('news.show');

Route::group(['middleware' => ['is.admin','auth'] ], function () {
    
    Route::get("/admin",'AdminController@index')->name('admin.main');
    Route::get("/admin/posts",'AdminController@posts')->name('admin.posts');
    Route::get("/admin/users",'AdminController@users')->name('admin.users');
    Route::get("/admin/edit-user/saveUser",'AdminController@saveUser')->name('admin.saveUser');
    Route::get("/admin/edit-user/{id}",'AdminController@editUser')->name('admin.editUser');

    Route::post('delete-user', 'JsonController@deleteUser');

});