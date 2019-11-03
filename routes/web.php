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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', 'MicropostsController@index');


// ユーザ登録
//※RegisterController.php←RegistersUsers.php : 登録はトレイトのRegistersUsers
//※入力フォーム先は定義はされているが、ブレードは存在しないため作成(views/auth/register.blade.php)
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン認証
//LoginController.php←AuthenticatesUsers.php : ログイン認証はトレイトのAuthenticatesUsers
//※入力フォーム先は定義はされているが、ブレードは存在しないため作成(views/auth/login.blade.php)
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);
    Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy']]);
});


// ユーザ機能
// middlewearのauthはファサードとして呼び出している(app/Http/Kernel.php,config/app.php)
Route::group(['middleware' => 'auth'], function () {
    //UserControllerはLaravelデフォルトのものではなく作成したもの。
    Route::resource('users', 'UsersController', ['only' => ['index', 'show']]);

    Route::group(['prefix' => 'users/{id}'], function () {
        Route::post('follow', 'UserFollowController@store')->name('user.follow');
        Route::delete('unfollow', 'UserFollowController@destroy')->name('user.unfollow');
        Route::get('followings', 'UsersController@followings')->name('users.followings');
        Route::get('followers', 'UsersController@followers')->name('users.followers');
    });

    Route::resource('microposts', 'MicropostsController', ['only' => ['store', 'destroy']]);
});





