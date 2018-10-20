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

Route::middleware('throttle:8,1')->group(function () {
    Route::get('profile/{user_model}', function (App\Models\User $user) {
        dd($user);
    })->middleware('token');
});

Route::get('/users/{user}', function (App\Models\User $user) {
    return 'the name is: ' . $user->name . ' ' . 'and the email is: ' . $user->email;
})->middleware('token');

//##########################文档测试#############################

//file
Route::post('file/upload', function (Request $request) {
    if($request->hasFile('photo') && $request->file('photo')->isValid()) {
        $photo = $request->file('photo');
        $extension = $photo->extension();
        $store_result = $photo->storeAs('photo', 'test.jpg');

        $output = [
            'extension' => $extension,
            'store_result' => $store_result
        ];

        print_r($output);exit();
    }
    exit('occure error!');
});

//respoonse json
Route::get('response/json', function () {
    return response()->json([
        'name' => 'glenn',
        'age' => 29
    ]);
});

//response file
Route::get('response/file', function () {
    return response()->download(storage_path('app/photo/test.jpg'), '测试图片.jpg')->deleteFileAfterSend(true);
});

//response view file
Route::get('response/viewfile/{id}', function (Request $request, $id) {
    return url()->current();
//    return response()->file(storage_path('app/photo/test.jpg'));
//    return response()->file(storage_path('app/photo/test.jpg'));
});

//paginate
Route::get('simpleusers', function () {
    return \App\Models\User::paginate(10);
});
