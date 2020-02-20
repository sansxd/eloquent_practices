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


//route User api
Route::apiResource('users', 'UserController');
Route::apiResource('posts', 'Api\PostController');

//register and login of authcontroller
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');

// Route::fallback(function () {
//     return response()->json(['Error' => 'Not Found!'], 404);
// });
