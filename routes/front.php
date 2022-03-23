<?php
use Illuminate\Support\Facades\Route;

Route::get('/', [\App\Http\Controllers\Front\HomeController::class, 'index'])->name('home');

Route::get('/suivi', [\App\Http\Controllers\Front\HomeController::class, 'suivi'])->middleware("auth")->name("suivi");
Route::post('/suivi/checkout', [\App\Http\Controllers\Front\HomeController::class, 'checkout'])->middleware("auth")->name("checkout");
Route::get('/suivi/checkout/success', [\App\Http\Controllers\Front\HomeController::class, 'checkoutSuccess'])->middleware("auth")->name("checkout.success");
Route::get('/suivi/checkout/cancel', [\App\Http\Controllers\Front\HomeController::class, 'checkoutCancel'])->middleware("auth")->name("checkout.cancel");
