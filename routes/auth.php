<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'as' => 'auth.',
    ],
    function () {
        Route::get('login', [AuthController::class, 'getLogin'])->name('login');
        Route::get('register', [AuthController::class, 'getRegister'])->name('register');
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    }
);
