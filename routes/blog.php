<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Blog\BlogController;

// Blog routes
Route::get('/', [BlogController::class, 'index'])->name('index');
Route::get('/category/{category:slug}', [BlogController::class, 'category'])->name('category');
Route::get('/tag/{tag:slug}', [BlogController::class, 'tag'])->name('tag');
Route::get('/{post:slug}', [BlogController::class, 'show'])->name('show');
