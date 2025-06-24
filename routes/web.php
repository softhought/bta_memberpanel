<?php

use App\Http\Controllers\Member\FeesPaymentsController;
use App\Http\Controllers\Member\TransactionsController;
use Illuminate\Support\Facades\Route;

/** Admin Section */
Route::prefix('admin')->middleware(['admin_auth'])->group(function () {

});

/** Member Section */
Route::prefix('member')->middleware(['member_auth'])->group(function () {
    Route::request('fetchHPView', [FeesPaymentsController::class, 'fetchHPView']);
    Route::request('fetchJHPView', [FeesPaymentsController::class, 'fetchJHPView']);
    Route::request('fetchJCPView', [FeesPaymentsController::class, 'fetchJCPView']);
    Route::request('fetchPFView', [FeesPaymentsController::class, 'fetchPFView']);


    Route::request('fetchMonths', [FeesPaymentsController::class, 'fetchMonths']);

    /** Transactions */
    Route::request('fetchTransactions', [TransactionsController::class, 'fetchTransactions']);
});
