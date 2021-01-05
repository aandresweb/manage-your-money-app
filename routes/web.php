<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;

Route::group(
    [
        'prefix' => 'transactions',
        'as' => 'transactions.',
        'middleware' => 'auth'
    ],
    function () {
        Route::get('/', [TransactionController::class, 'index'])->name('index');
        Route::get('/all', [TransactionController::class, 'all'])->name('all');
        Route::get('/{transaction}', [TransactionController::class, 'show'])->name('show');
        Route::post('/', [TransactionController::class, 'store'])->name('store');
        Route::delete('/{id}', [TransactionController::class, 'delete'])->name('delete');
    }
);


Route::group(
    [
        'prefix' => 'areas',
        'as' => 'areas.',
        'middleware' => 'auth'
    ],
    function () {
        Route::get('/', [AreaController::class, 'index'])->name('index');
        Route::get('/all', [AreaController::class, 'all'])->name('all');
        Route::post('/', [AreaController::class, 'store'])->name('store');
        Route::delete('/{id}', [AreaController::class, 'delete'])->name('delete');
    }
);
