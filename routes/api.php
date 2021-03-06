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
    Route::get('card/{number}/plafond', [\App\Http\Controllers\Api\AccountController::class, 'getPlafond']);
    Route::get('card/{number}/code', [\App\Http\Controllers\Api\AccountController::class, 'getCode']);
    Route::get('card/{number}/externalPayment', [\App\Http\Controllers\Api\AccountController::class, 'externalPayment']);
    Route::get('card/{number}/abroadPayment', [\App\Http\Controllers\Api\AccountController::class, 'abroadPayment']);

    Route::post('check', [\App\Http\Controllers\Api\AccountController::class, 'storeCheck']);
    Route::put('check/{reference}/status', [\App\Http\Controllers\Api\AccountController::class, 'updateStatusCheck']);

    Route::delete('levy/{uuid}', [\App\Http\Controllers\Api\AccountController::class, 'deleteLevy']);
    Route::delete('levy', [\App\Http\Controllers\Api\AccountController::class, 'deleteLevies']);

    Route::get('/document/{id}', [\App\Http\Controllers\Api\AccountController::class, 'getDocument']);
});

Route::prefix('transaction')->group(function () {
    Route::get('{uuid}', [\App\Http\Controllers\Api\TransactionController::class, 'info']);
});

