<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Member\FeesPaymentsController;
use App\Http\Controllers\Member\TransactionsController;
use App\Models\Menu;
use Illuminate\Support\Facades\Route;

Route::post('admin/auth', [UserController::class, 'auth'])->name('admin.auth');
Route::post('member/auth', [UserController::class, 'memberAuth'])->name('member.auth');
Route::get('admin/logout/{role}', [UserController::class, 'logout']);
Route::get('/', [UserController::class, 'member']);

Route::prefix('admin')->middleware(['admin_auth'])->group(function () {

    $menus = Menu::all()->where('menu_for', 'Admin')->whereNotNull('controller');
    foreach ($menus as $list) {
        $controller = "App\Http\Controllers\Admin\\" . $list['controller'];
        Route::get($list['route'], [$controller, $list['method']]);
    }

});

Route::get('admin', [UserController::class, 'index']);

/** Member Section */
Route::prefix('member')->middleware(['member_auth'])->group(function () {

    $menus = Menu::all()->where('menu_for', 'Member')->whereNotNull('controller');
    foreach ($menus as $list) {
        $controller = "App\Http\Controllers\Member\\" . $list['controller'];
        Route::get($list['route'], [$controller, $list['method']]);
    }

    Route::post('fetchHPView', [FeesPaymentsController::class, 'fetchHPView']);
    Route::post('fetchJHPView', [FeesPaymentsController::class, 'fetchJHPView']);
    Route::post('fetchJCPView', [FeesPaymentsController::class, 'fetchJCPView']);
    Route::post('fetchPFView', [FeesPaymentsController::class, 'fetchPFView']);


    Route::post('fetchMonths', [FeesPaymentsController::class, 'fetchMonths']);

    /** Transactions */
    Route::post('fetchTransactions', [TransactionsController::class, 'fetchTransactions']);
});

Route::get('member', [UserController::class, 'member']);
