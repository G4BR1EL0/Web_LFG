<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PartyController;
use App\Http\Controllers\PartyUsersController;
use App\Http\Controllers\ChatController;


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
            Route::get('/user', function (Request $request) {
                return $request->user();
            });
            Route::patch('update/user/{id}', [UserController::class, 'edit']);
        });
});

Route::group(
    [ 'prefix' => 'game'], function ()
{
    Route::group(
        ['middleware' => 'auth:api'], function(){
            Route::get('/', [GameController::class, 'getGames']);
            Route::group(
            ['middleware' => ['scope:admin']], function(){
                Route::post('/', [GameController::class, 'createGame']);
                Route::delete('delete/{id}', [GameController::class, 'deleteGames']);
                }
            );
        }
    );
});


Route::group(
    ['prefix' => 'party'],
    function () {
        Route::post('create', [PartyController::class, 'create']);
        // Use this group with middleware to can get User from request
        Route::group(
            ['middleware' => 'auth:api'],
            function () {
                Route::get('/', [PartyController::class, 'getParties']);
                Route::get('/{game_id}', [PartyController::class, 'getGameParties']);
                Route::post('addUser', [PartyUsersController::class, 'create']);
                Route::delete('removeUser', [PartyUsersController::class, 'deleteUser']);
                Route::delete('delete', [PartyController::class, 'delete']);
            }
        );
    }
);


Route::group(
    ['prefix' => 'chat'],
    function () {
        Route::group(
            ['middleware' => 'auth:api'],
            function () {
                Route::post('send/{partyId}', [ChatController::class, 'createMessage']);
                Route::get('msg', [ChatController::class, 'getMessages']);
                Route::patch('edit/{id}', [ChatController::class, 'editMessage']);
                Route::delete('delete/{id}', [ChatController::class, 'destroyMessage']);
            }
        );
    }
);
