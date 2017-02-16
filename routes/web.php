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
//管理员登陆注销
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
//管理员密码找回
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
//后台页面
Route::group(['prefix'=>'admin','middleware'=>'auth','namespace'=>'Backend','as'=>'admin.'],function(){
    //后台主页
    Route::get('/','HomeController@index')->name('home');
    //用户管理
    Route::group(['namespace'=>'User'],function(){
        //ajax读取接口
        Route::post('user/get','UserTableController')->name('user.get');
        //用户CRUD
        Route::resource('user','UserController',['except'=>'show']);
        //用户操作
        Route::group(['prefix'=>'user/{user}'],function(){
            //修改用户密码
            Route::get('password-change','UserPasswordController@edit')->name('user.change-password');
            Route::put('password-change','UserPasswordController@update')->name('user.change-password');
        });
    });
});

Route::get('/home', 'HomeController@index');
