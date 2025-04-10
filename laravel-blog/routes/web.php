<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;

Route::get('/', [ArticleController::class, 'index'])->name('articles.index');

Route::get('/search', [ArticleController::class, 'search'])->name('articles.search');

Route::get('/category/{slug}', [ArticleController::class, 'filterByCategory'])->name('category.show');

Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/categorie/{slug}', [CategoryController::class, 'show'])->name('category.show');
