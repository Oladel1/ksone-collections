<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PaystackController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PasswordResetController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Phase 1: Intro page (dynamic categories)
Route::get('/', [PageController::class, 'intro'])->name('intro');

// Dynamic category page: /c/footwear, /c/bags, etc.
Route::get('/c/{category:slug}', [PageController::class, 'category'])->name('category');

// Backward-compatible aliases for the original footwear routes
Route::get('/footwear', fn () => redirect()->route('category', 'footwear'))->name('footwear');
Route::get('/footware', fn () => redirect()->route('category', 'footwear'))->name('footwear.alt');

// Paystack payment verification
Route::post('/api/paystack/verify', [PaystackController::class, 'verify'])->name('paystack.verify');


/*
|--------------------------------------------------------------------------
| Admin Auth Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Password Reset (email-based)
    Route::get('/forgot-password',  [PasswordResetController::class, 'showForgotForm'])->name('admin.password.request');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink'])->name('admin.password.email');
    Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password',  [PasswordResetController::class, 'reset'])->name('admin.password.update');
});


/*
|--------------------------------------------------------------------------
| Admin Dashboard Routes (requires auth)
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->middleware('admin')->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Change Own Password
    Route::get('change-password', [PasswordResetController::class, 'showChangeForm'])->name('admin.password.change.form');
    Route::post('change-password', [PasswordResetController::class, 'changePassword'])->name('admin.password.change');

    // Categories
    Route::resource('categories', CategoryController::class)->names('admin.categories');
    Route::post('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])
        ->name('admin.categories.toggle-status');

    // Products
    Route::resource('products', ProductController::class)->names('admin.products');
    Route::post('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])
        ->name('admin.products.toggle-status');

    // Orders
    Route::get('orders', [OrderController::class, 'index'])->name('admin.orders.index');
    Route::get('orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
    Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])
        ->name('admin.orders.update-status');

    // Site Settings
    Route::get('settings', [SettingController::class, 'index'])->name('admin.settings.index');
    Route::post('settings', [SettingController::class, 'update'])->name('admin.settings.update');

    // Users (super admin + permission)
    Route::resource('users', UserController::class)->names('admin.users')->except('show');
    Route::post('users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('admin.users.reset-password');

    // Roles (super admin + permission)
    Route::resource('roles', RoleController::class)->names('admin.roles')->except('show');
});
