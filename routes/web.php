<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

// Phase 1: Intro page
Route::get('/', [PageController::class, 'intro'])->name('intro');

// Phase 2: Footwear one-page site
Route::get('/footwear', [PageController::class, 'footwear'])->name('footwear');
