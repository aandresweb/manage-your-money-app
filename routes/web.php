<?php

use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'transactions',
        'as' => 'transactions.'
    ],
    function () {
        Route::get('/', [TransactionController::class, 'index'])->name('index');
        Route::get('/all', [TransactionController::class, 'all'])->name('all');
        Route::get('/{transaction}', [TransactionController::class, 'show'])->name('show');
    }
);
