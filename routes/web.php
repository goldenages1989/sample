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

Route::get('/','StaticPagesController@home')->name('home');
Route::get('/help','StaticPagesController@help')->name('help');
Route::get('/about','StaticPagesController@about')->name('about');

Route::get('/signup','UsersController@create')->name('signup');
Route::resource('users', 'UsersController');

Route::get('/login', 'SessionsController@create')->name('login');
Route::post('/login', 'SessionsController@store')->name('login');
Route::delete('/logout', 'SessionsController@destory')->name('logout');

//account activation
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');

//password reset
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

Route::resource('statuses', 'StatusesController', ['only' => ['store', 'destroy']]);

//############################文档测试##################################
//test
Route::get('user/{id?}/profile', function ($id = 2) {
    $url = route('profile');
    return $url;
})->name('profile');

//subdomain
Route::domain('{subdomain}.sample.me')->group(function () {
    Route::get('post/{id}/profile', function ($subdomain, $id) {
        return 'This is ' . $subdomain . ' page of User ' . $id;
    });
});

//prefix
//Route::prefix('admin')->group(function () {
//    Route::get('/user', function () {
//        $url = route('post');
//        return $url;
//    })->name('post');
//});

//prefix
Route::name('admin.')->group(function () {
    Route::get('users', function () {
        $url = route('users');
        return $url;
    })->name('users');
});

Route::get('form', function () {
    return '<form method="post" action="/foo"><button type="submit">提交</button></form>';
});

//csrf token
Route::get('form_without_csrf_token', function () {
    return '<form method="POST" action="/hello_from_form"><button type="submit">提交</button></form>';
});

Route::get('form_with_csrf_token', function () {
    return '<form method="POST" action="/hello_from_form">' . csrf_field() . '<button type="submit">提交</button></form>';
});

Route::get('hello_from_form', function () {
    return 'hello laravel!';
});

//response
Route::get('cookie/add', function () {
    $minutes = 2;
    return response('welcome to laravel demo!')->cookie('name','laravel name',$minutes);
});

Route::get('cookie/get', function (\Illuminate\Http\Request $request) {
    $cookie = $request->cookie('name');
    dd($cookie);
});

//eloquent
Route::get('/citys', 'CityController@index');



Route::get('/home', 'HomeController@index')->name('home');
