<?php

use App\Http\Controllers\DeployController;
use App\Http\Controllers\Member\FeesPaymentsController;
use App\Http\Controllers\Member\MemberController;
use App\Http\Controllers\Member\TransactionsController;
use App\Http\Controllers\Admin\AdminTransactionsController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

Route::request('webhook/deploy', [DeployController::class, 'pullCode']);
/** Admin Section */
Route::prefix('admin')->middleware(['admin_auth'])->group(function () {
    Route::request('fetchUserTransactionView', [AdminTransactionsController::class, 'fetchUserTransactionView']);
    Route::request('fetchTransactions', [AdminTransactionsController::class, 'fetchTransactions']);
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

    /** Others */
    Route::request('changePassword', [MemberController::class, 'changePassword']);
    Route::request('changePasswordAction', [MemberController::class, 'changePasswordAction']);
    Route::request('forceChangePassword', [MemberController::class, 'forceChangePassword']);

    Route::request('profile', [MemberController::class, 'profile']);
    Route::request('profileAction', [MemberController::class, 'profileAction']);

});

/** Payments */
Route::post('member/ipayments', [PaymentController::class, 'payment']);
Route::post('payment-response', [PaymentController::class, 'paymentResponse']);
Route::get('response', [PaymentController::class, 'response']);
