<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;

Route::get('/', [ArticleController::class, 'index'])->name('articles.index');

Route::get('/search', [ArticleController::class, 'search'])->name('articles.search');

// Route de détail des articles
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('articles.show');

// Route de vue d'une catégorie (si besoin d'une page spécifique)
Route::get('/categorie/{slug}', [CategoryController::class, 'show'])->name('category.show');
