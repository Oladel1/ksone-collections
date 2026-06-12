<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PaystackController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Phase 1: Intro page
Route::get('/', [PageController::class, 'intro'])->name('intro');

// Phase 2: Footwear one-page site
Route::get('/footwear', [PageController::class, 'footwear'])->name('footwear');
Route::get('/footware', [PageController::class, 'footwear'])->name('footwear.alt');

// Paystack payment verification
Route::post('/api/paystack/verify', [PaystackController::class, 'verify'])->name('paystack.verify');
