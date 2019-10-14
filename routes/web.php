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
Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/send', 'HomeController@sendEmailSample')->name('home');


Route::post('/posts', 'PostController@submitPost');
Route::get('/posts', 'PostController@getPosts');
Route::post('/posts/update', 'PostController@updatePost');
Route::delete('/posts/delete/{id}', 'PostController@deletePost');
Route::post('/posts/like/{id}', 'PostController@likePost');
Route::post('/triggerMyEvent', 'PostController@triggerMyEvent');

///Admin Post Tables
Route::get('/ptables', 'PostPaginationController@index');
Route::get('/posttables', 'PostController@postTables')->name('post.tables');

Route::get('/user-posts/{id}', 'UserPostsController@index')->name('user.posts');
Route::get('/getuser-posts/{id}', 'UserPostsController@getUserPosts');
