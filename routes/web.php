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

Route::get('/', 'HomeController@home')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('/topic','TopicController',['only'=>['create','show','edit','update','destroy']])->except('show');
    Route::resource('/comment','CommentController',['only'=>['update','destroy']]);
    Route::post('/topic/comment/create/{topic}','CommentController@storeComment')->name('topic.comment.create');
});

Auth::routes();
