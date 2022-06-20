<?php

declare(strict_types=1);

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\MovieController;
use App\Http\Controllers\Api\UserController;
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
Route::controller(AuthController::class)->prefix('auth')->group(static function (): void {
    Route::post('sign-up', 'register');
    Route::post('login', 'login');

    Route::middleware('auth:api')->group(static function (): void {
        Route::post('logout', 'logout');
        Route::get('me', 'me');
    });
});

Route::controller(MovieController::class)
    ->group(static function (): void {
        Route::get('movies', 'index');
        Route::get('movies/movie', 'show');
        Route::middleware('auth:api')
            ->group(static function (): void {
                Route::post('movies', 'store');
                Route::patch('/moves/{movies}','update');
                Route::delete('/moves/{movies}', 'destroy');
                Route::get('movies/{userId}/my', 'getByAuthUser');
            });
    });

Route::controller(UserController::class)
    ->prefix('/users')
    ->middleware('auth:api')
    ->group(static function (): void {
        Route::get('/', 'getAll');
        Route::get('/{id}', 'getByUserId');
    });
