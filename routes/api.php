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

Route::prefix("account")->group(function () {
    Route::post('contact', [\App\Http\Controllers\Api\AccountController::class, 'contact']);
    Route::post('bank', [\App\Http\Controllers\Api\AccountController::class, 'bankInfo']);
    Route::post('simulate', [\App\Http\Controllers\Api\AccountController::class, 'simulate']);
    Route::post('signate', [\App\Http\Controllers\Api\AccountController::class, 'signate']);
    Route::post('card', [\App\Http\Controllers\Api\AccountController::class, 'getCard']);
    Route::post('card/{number}/lock', [\App\Http\Controllers\Api\AccountController::class, 'lockCard']);
});

Route::prefix('transaction')->group(function () {
    Route::get('{uuid}', [\App\Http\Controllers\Api\TransactionController::class, 'info']);
});

