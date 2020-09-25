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
Route::get('/','NewsItemController@index')->name('index');
Route::get('post/','NewsItemController@create')->name('news.create');
Route::post('news/store','NewsItemController@store')->name('news.store');
Route::get('posts/{id}','NewsItemController@show')->name('news.show');

