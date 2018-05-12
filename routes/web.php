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
    Route::resource('/topic','TopicController',['except' => ['show']]);
    Route::resource('/comment','CommentController',['except' => ['show']]);
    Route::post('/topic/comment/create/{topic}','CommentController@storeComment')->name('topic.comment.create');
    Route::post('/topic/comment/reply/create/{comment}','CommentController@storeReply')->name('topic.reply.create');
    Route::PATCH('/comment/reply/update/{comment}','CommentController@replyUpdate')->name('reply.update');
    Route::DELETE('/comment/reply/delete/{comment}','CommentController@replyDestroy')->name('reply.delete');
    Route::post('/topic/comment/bestanswer/{topic}','TopicController@bestAnswer')->name('bestAnswer');
    Route::post('/topic/likeTopic','LikeController@likeTopic')->name('likeTopic');
    Route::get('/user/{user}','UserProfileController@show')->name('user.show');
});
Route::resource('/topic','TopicController',['only'=>['create','store','show','edit','update','destroy']]);
Route::resource('/comment','CommentController',['only'=>['show','update','destroy']]);

Auth::routes();
