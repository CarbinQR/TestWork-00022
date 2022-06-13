<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FilmController;
use App\Http\Controllers\Api\MovieController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(AuthController::class)->prefix('auth')->group(function () {
    Route::post('sign-up', 'register');
    Route::post('login', 'login');

    Route::middleware('auth:api')->group(function () {
        Route::post('logout', 'logout');
        Route::get('me', 'me');
    });
});

Route::controller(MovieController::class)
    ->prefix('/movies')
    ->middleware('auth:api')
    ->group(function () {
        Route::post('/', 'create');
        Route::patch('/', 'update');
        Route::delete('/', 'delete');
        Route::get('/', 'getByAuthUser');
        Route::get('/{id}', 'getById');
    });
