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

// login/register routes
Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
    // teams
    Route::delete('team/{id}', 'API\TeamController@destroy');
    Route::post('team', 'API\TeamController@create');
    Route::get('team/{id}', 'API\TeamController@show');
    Route::patch('team/{id}', 'API\TeamController@update');
    Route::get('teams', 'API\TeamController@index');

    // members
    Route::delete('member/{id}', 'API\MemberController@destroy');
    Route::post('team/{tid}/member', 'API\MemberController@create');
    Route::get('team/{tid}/members', 'API\MemberController@index');
    Route::get('member/{id}', 'API\MemberController@show');
    Route::patch('member/{id}', 'API\MemberController@update');
});
