<?php
use Illuminate\Support\Facades\Route;

Route::prefix("auth")->group(function () {
    Route::get('verifyIdentity', [\App\Http\Controllers\AuthController::class, 'verifyIdentity']);
    Route::get('authCode', [\App\Http\Controllers\AuthController::class, 'authCode']);
    Route::post('authCode', [\App\Http\Controllers\AuthController::class, 'authCodeInsert']);

    Route::get('code', [\App\Http\Controllers\AuthController::class, 'code'])->name('auth.code');
    Route::post('code/verify', [\App\Http\Controllers\AuthController::class, 'codeVerify'])->name('auth.code.verify');
});
