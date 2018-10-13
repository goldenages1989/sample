<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users/{user}', function (App\Models\User $user) {
    return 'the name is: ' . $user->name . ' ' . 'and the email is: ' . $user->email;
});

Route::get('profile/{user_model}', function (App\Models\User $user) {
    dd($user);
});
