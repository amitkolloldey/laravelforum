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


use Cviebrock\EloquentTaggable\Models\Tag;

Route::get('/', 'HomeController@home')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('/topic','TopicController',['except' => ['show']]);
    Route::resource('/comment','CommentController',['except' => ['show']]);

    Route::post('/topic/comment/create/{topic}','CommentController@storeComment')->name('topic.comment.create');
    Route::get('/tag/{tag}/topics','TopicController@sortByTags')->name('tag.topics');
    Route::post('/topic/comment/reply/create/{comment}','CommentController@storeReply')->name('topic.reply.create');
    Route::PATCH('/comment/reply/update/{comment}','CommentController@replyUpdate')->name('reply.update');
    Route::DELETE('/comment/reply/delete/{comment}','CommentController@replyDestroy')->name('reply.delete');
    Route::post('/topic/comment/bestanswer/{topic}','TopicController@bestAnswer')->name('bestAnswer');
    Route::post('/notification/makeAsRead/','TopicController@makeAsRead')->name('makeAsRead');
    Route::post('/topic/likeTopic','LikeController@likeTopic')->name('likeTopic');
    Route::get('/user/{user}','UserProfileController@show')->name('user.show');
    Route::get('/tag/{tag}',function (){
        $tags = Tag::all()->pluck('name')->toArray();
        return response($tags);
    });
});
Route::get('/topic/show/{topic}','TopicController@show')->name('topic.show');
Route::get('login/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.login');
Route::get('login/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback')->name('social.login.callback');
Auth::routes();
