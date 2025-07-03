<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Member\MemberController;
use App\Models\Menu;
use Illuminate\Support\Facades\Route;

Route::request('admin/auth', [UserController::class, 'auth'])->name('admin.auth');
Route::request('member/auth', [UserController::class, 'memberAuth'])->name('member.auth');
Route::request('admin/logout/{role}', [UserController::class, 'logout']);
Route::request('/', [UserController::class, 'member']);

Route::prefix('admin')->middleware(['admin_auth'])->group(function () {
    $menus = Menu::all()->where('menu_for', 'Admin')->whereNotNull('controller');
    foreach ($menus as $list) {
        $controller = "App\Http\Controllers\Admin\\" . $list['controller'];
        Route::request($list['route'], [$controller, $list['method']]);
    }
});

Route::request('admin', [UserController::class, 'index']);

/** Member Section */
Route::prefix('member')->middleware(['member_auth'])->group(function () {
    $menus = Menu::all()->where('menu_for', 'Member')->whereNotNull('controller');
    foreach ($menus as $list) {
        $controller = "App\Http\Controllers\Member\\" . $list['controller'];
        Route::request($list['route'], [$controller, $list['method']]);
    }
});

Route::request('member', [UserController::class, 'member']);
Route::request('about-us', [MemberController::class, 'aboutUs']);
Route::request('contact-us', [MemberController::class, 'contactUs']);
Route::request('privacy-policy', [MemberController::class, 'privacyPolicy']);
Route::request('terms-and-conditions', [MemberController::class, 'termsAndConditions']);
Route::request('refund-policy', [MemberController::class, 'refundPolicy']);
Route::request('enquiry-submit', [MemberController::class, 'enquirySubmit'])->name('enquiry.submit');