<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Phase 1 — Intro / hub page
Route::get('/', [PageController::class, 'intro'])->name('intro');

// Phase 2 — Individual collection pages (coming soon)
// Route::get('/footwear', [PageController::class, 'footwear'])->name('footwear');
// Route::get('/bags',     [PageController::class, 'bags'])->name('bags');
// Route::get('/belts',    [PageController::class, 'belts'])->name('belts');
// Route::get('/wallets',  [PageController::class, 'wallets'])->name('wallets');
