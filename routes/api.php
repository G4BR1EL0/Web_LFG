<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PartyController;


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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
   // return $request->user();
//});


Route::group(

    [ 'prefix' => 'auth'], function ()
{
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'singUp']);
    Route::group(
        ['middleware' => 'auth:api'], function(){
            Route::get('logout', [AuthController::class, 'logout']);
            Route::get('/user', function (Request $request) {
                return $request->user();
            });
            Route::patch('update/user/{id}', [UserController::class, 'edit']);
        });
});


Route::group(
    ['prefix' => 'party'],
    function () {
        Route::post('create', [PartyController::class, 'create']);
        // Use this group with middleware to can get User from request
        Route::group(
            ['middleware' => 'auth:api'],
            function () {
                Route::delete('delete', [PartyController::class, 'delete']);
            }
        );
    }
);


//Route::post('/create', '\App\Http\Controllers\PartyController');
