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

Route::get('posts/{postId?}', function ($postId = 1) {
    return 'Post Id: ' . $postId;
})->name('posts');

Route::get('test', 'TestController@test')->name('test');

Route::get('posts/{postId}/comments/{commentId}', function ($postId, $commentId) {
    return 'Post ID:' . $postId . ' Comment ID: ' . $commentId;
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

// modelを利用
Route::get('postmodel', 'PostModelController@show');

// 階層化
// Route::get('board', 'Admin\AdminController');

// 同じnamespaceを利用
Route::namespace ('Admin')->group(function () {
    // Controllers Within The "App\Http\Controllers\Admin" Namespace
});

Route::group(['prefix' => 'agent', 'namespace' => 'Agent'], function () {
    Route::get('/list', 'AgentController@list')->name('agent.list');
    Route::post('/store', 'AgentController@store')->name('agent.store');

});

/**
 * use auth middleware
 */
Auth::routes();
Route::get('/login', 'Auth\LoginController@userLogout')->name('user.login');
Route::get('/logout', 'Auth\LoginController@userLogout')->name('user.logout');

// Route::group(['middleware' => 'auth'], function () {
//     // mypage
//     Route::get('/mypage', 'Auth\MypageController@show')->name('showUserProfile');
//     Route::post('/mypage', 'Auth\MypageController@update')->name('updateUser');
//     // example
//     Route::get('/listExample', 'Example\ListExampleController@index')->name('indexListExample');
//     Route::post('/listExample', 'Example\ListExampleController@show')->name('showListExample');
//     Route::get('/entryExample', 'Example\EntryExampleController@index')->name('indexEntryExample');
//     Route::post('/entryExample', 'Example\EntryExampleController@store')->name('storeEntryExample');
//     Route::get('/detailExample/{id?}', 'Example\DetailExampleController@show')->name('showDetailExample');
// });

/**
 * use admin auth middleware
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Account'], function () {
    Route::get('/', function () {return redirect()->route('admin.top');});
    Route::get('/top', 'AccountTopController@index')->name('admin.top');
    Route::get('/login', 'Auth\AccountLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AccountLoginController@login')->name('admin.login.submit');
    Route::get('/logout', 'Auth\AccountLoginController@logout')->name('admin.logout');

    // Password reset routes
    Route::post('/password/email', 'Auth\AccountForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\AccountForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\AccountResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AccountResetPasswordController@showResetForm')->name('admin.password.reset');
});

/**
 * use agent auth middleware
 */
Route::group(['prefix' => 'agent', 'namespace' => 'AgentAccount'], function () {
    Route::get('/', function () {return redirect()->route('agent.top');});
    Route::get('/top', 'AgentAccountTopController@index')->name('agent.top');
    Route::get('/login', 'Auth\AgentAccountLoginController@showLoginForm')->name('agent.login');
    Route::post('/login', 'Auth\AgentAccountLoginController@login')->name('agent.login.submit');
    Route::get('/logout', 'Auth\AgentAccountLoginController@logout')->name('agent.logout');

    // Password reset routes
    Route::post('/password/email', 'Auth\AgentAccountForgotPasswordController@sendResetLinkEmail')->name('agent.password.email');
    Route::get('/password/reset', 'Auth\AgentAccountForgotPasswordController@showLinkRequestForm')->name('agent.password.request');
    Route::post('/password/reset', 'Auth\AgentAccountResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\AgentAccountResetPasswordController@showResetForm')->name('agent.password.reset');
});

/**
 * use company auth middleware
 */
Route::group(['prefix' => 'company', 'namespace' => 'CompanyAccount'], function () {
    Route::get('/', function () {return redirect()->route('company.top');});
    Route::get('/top', 'CompanyAccountTopController@index')->name('company.top');
    Route::get('/login', 'Auth\CompanyAccountLoginController@showLoginForm')->name('company.login');
    Route::post('/login', 'Auth\CompanyAccountLoginController@login')->name('company.login.submit');
    Route::get('/logout', 'Auth\CompanyAccountLoginController@logout')->name('company.logout');

    // Password reset routes
    Route::post('/password/email', 'Auth\CompanyAccountForgotPasswordController@sendResetLinkEmail')->name('company.password.email');
    Route::get('/password/reset', 'Auth\CompanyAccountForgotPasswordController@showLinkRequestForm')->name('company.password.request');
    Route::post('/password/reset', 'Auth\CompanyAccountResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\CompanyAccountResetPasswordController@showResetForm')->name('company.password.reset');
});
