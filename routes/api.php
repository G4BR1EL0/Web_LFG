<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(
    [ 'prefix' => 'auth'], function ()
{
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'singUp']);
    Route::group(
        ['middleware' => 'auth:api'], function(){
            Route::get('logout', [AuthController::class, 'logout']);
            Route::post('game', [GameController::class, 'createGame']);
            Route::get('game', [GameController::class, 'getGames']);
        });
});

Route::group(
    [ 'prefix' => 'game'], function ()
{
    Route::group(
        ['middleware' => 'auth:api'], function(){
            Route::get('/', [GameController::class, 'getGames']);
        }
    );
    
    Route::group(
        ['middleware' => ['auth:api','scope:admin']], function(){
            Route::post('/', [GameController::class, 'createGame']);
            Route::delete('delete/{id}', [GameController::class, 'deleteGames']);
        }
    );
});


Route::apiResource('/parties', '\App\Http\Controllers\PartyController');

