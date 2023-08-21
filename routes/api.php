<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


// routes/api.php

Route::group(['prefix' => 'v1'], function () {

    Route::group(
        ['prefix' => 'auth'],
        function () {
            Route::post('signup', [\App\Http\Controllers\Api\v1\Authentication\Controller::class, 'manualSignup']);
            Route::post('login', [\App\Http\Controllers\Api\v1\Authentication\Controller::class, 'manualSignIn']);
            Route::post('password/email', [\App\Http\Controllers\Api\v1\Authentication\Controller::class, 'sendResetLinkEmail']);
        }
    );


    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('user', function (Request $request) {
            return response()->json(['user' => $request->user()], 200);
        });
        Route::get('logout', [\App\Http\Controllers\Api\v1\Authentication\Controller::class, 'logout']);

        //wallet api

        Route::post('add-funds', [\App\Http\Controllers\Api\v1\WalletController::class, 'addFunds']);

        //Cookie api

        Route::post('/buy-cookie', [\App\Http\Controllers\Api\v1\CookieController::class, 'buyCookie']);
        Route::get('/cookies', [\App\Http\Controllers\Api\v1\CookieController::class, 'getUserCookies']);
    });
});
