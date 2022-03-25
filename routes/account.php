<?php
use Illuminate\Support\Facades\Route;

Route::middleware(["auth", "open"])->prefix('compte')->group(function () {
    Route::get('/', [\App\Http\Controllers\Account\AccountController::class, 'dashboard'])->name("account.dashboard");
    Route::get('/compte/{uuid}', [\App\Http\Controllers\Account\AccountController::class, 'detail'])->name("account.detail");

    Route::prefix("transfer")->group(function () {
        Route::get('/', [\App\Http\Controllers\Account\TransferController::class, 'index'])->name("account.transfer.index");
        Route::get('create', [\App\Http\Controllers\Account\TransferController::class, 'create'])->name("account.transfer.create");
        Route::post('create', [\App\Http\Controllers\Account\TransferController::class, 'store'])->middleware(["code"])->name("account.transfer.store");

        Route::prefix('history')->group(function() {
            Route::get('/', [\App\Http\Controllers\Account\TransferController::class, 'history'])->name('account.transfer.history');
        });

        Route::prefix("wise")->group(function () {
            Route::get('create', [\App\Http\Controllers\Account\TransferController::class, 'wiseCreate'])->name("account.transfer.wise.create");
            Route::post('create', [\App\Http\Controllers\Account\TransferController::class, 'wiseStore'])->name("account.transfer.wise.store");
        });

        Route::prefix("beneficiaire")->group(function () {
            Route::get('/', [\App\Http\Controllers\Account\BeneficiaireController::class, 'list'])->name("account.transfer.beneficiaire.list");
            Route::get('create', [\App\Http\Controllers\Account\BeneficiaireController::class, 'create'])->name("account.transfer.beneficiaire.create");
            Route::post('create', [\App\Http\Controllers\Account\BeneficiaireController::class, 'store'])->middleware(["code"])->name("account.transfer.beneficiaire.store");
            Route::get('{uuid}', [\App\Http\Controllers\Account\BeneficiaireController::class, 'edit'])->name("account.transfer.beneficiaire.edit");
            Route::put('{uuid}', [\App\Http\Controllers\Account\BeneficiaireController::class, 'update'])->name("account.transfer.beneficiaire.update");
            Route::delete('{uuid}', [\App\Http\Controllers\Account\BeneficiaireController::class, 'destroy'])->name("account.transfer.beneficiaire.destroy");
        });
    });

    Route::prefix("payments")->group(function () {
        Route::get('/', [\App\Http\Controllers\Account\PaymentController::class, 'index'])->name("account.payments.index");
    });

    Route::prefix("insurance")->group(function () {
        Route::get('/')->name("account.insurance.index");
    });

    Route::prefix("subscribe")->group(function () {
        Route::get('/', [\App\Http\Controllers\Account\SubscriptionController::class, 'index'])->name("account.subscribe.index");
        Route::post('/', [\App\Http\Controllers\Account\SubscriptionController::class, 'store'])->name("account.subscribe.store");
        Route::get('overdraft', [\App\Http\Controllers\Account\SubscriptionController::class, 'overdraft'])->name("account.subscribe.overdraft");
    });

    Route::prefix('settings')->group(function () {
        Route::get('profil', [\App\Http\Controllers\Account\SettingsController::class, 'profil'])->name("account.settings.profil");
        Route::post('profil', [\App\Http\Controllers\Account\SettingsController::class, 'updateProfil'])->name("account.settings.updateProfil");
        Route::get('notification', [\App\Http\Controllers\Account\SettingsController::class, 'notification'])->name("account.settings.notification");
        Route::get('password', [\App\Http\Controllers\Account\SettingsController::class, 'password'])->name("account.settings.password");
        Route::put('password', [\App\Http\Controllers\Account\SettingsController::class, 'updatePassword'])->name("account.settings.updatePassword");
        Route::get('code', [\App\Http\Controllers\Account\SettingsController::class, 'code'])->name("account.settings.code");
        Route::put('code', [\App\Http\Controllers\Account\SettingsController::class, 'updateCode'])->name("account.settings.updateCode");
        Route::get('instant', [\App\Http\Controllers\Account\SettingsController::class, 'instant'])->name("account.settings.instant");
        Route::put('instant', [\App\Http\Controllers\Account\SettingsController::class, 'updateInstant'])->name("account.settings.updateInstant");
    });
});
