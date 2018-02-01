<?php

use App\User;

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

Route::get('users', function () {
    $users = User::all();

    return View::make('users')->with('users', $users);
});

// Route::get('posts', function () {
//     return 'Test message';
// });

Route::get('login', function () {
    return 'Login';
})->name('login');

Route::get('posts/{postId?}', function ($postId = 1) {
    return 'Post Id: ' . $postId;
})->name('posts');

Route::get('test', 'TestController@test')->name('test');

Route::get('posts/{postId}/comments/{commentId}', function ($postId, $commentId) {
    return 'Post ID:' . $postId . ' Comment ID: ' . $commentId;
});

// Route::get('dashboard', function () {
//     return 'Dashboard';
// })->middleware('auth');

// 上記コードををgroup化する
// middleware
Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', function () {
        return 'Dashboard';
    });

    Route::get('user/profile', function () {
        return 'User Profile';
    });
});

// namespace ->
Route::group(['namespace' => 'Admin'], function () {
    // App\Http\Controllers\Admin
});

// prefix (url階層)
Route::group(['prefix' => 'system'], function () {
    Route::get('show', function () {
        // /system/show
    });
});

// middlewareを個別に設定
// Route::get('user/{id}', 'UserController@show')->middleware('auth');
// Route::post('user/{id}', 'UserController@edit')->middleware(['auth', 'can']);

// resourceを利用
// Route::resource('post', 'PostController');

// 使うrouteを指定可能
// Route::resource('post', 'PostController', ['only' => ['index', 'show', 'delete']]);

// 使わないrouteを指定可能
// Route::resource('post', 'PostController', ['except' => ['index', 'show', 'delete']]);

// 階層化する例:user/{user}/post/{post}
// get user/4/post9 -> show
// get user/4/post9 -> index
Route::resource('user.post', 'PostController');

// 階層化
// Route::get('board', 'Admin\AdminController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
