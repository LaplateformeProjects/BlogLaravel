<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\AdminCommentController;
use App\Http\Controllers\DashboardController;

// Routes pour la partie publique du blog
Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/search', [ArticleController::class, 'search'])->name('articles.search');
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/categorie/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::post('/article/{article}/comments', [CommentController::class, 'store'])->name('comments.store');

// Routes pour la partie Admin du blog
Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/articles', [AdminArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [AdminArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [AdminArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [AdminArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [AdminArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [AdminArticleController::class, 'destroy'])->name('articles.destroy');

    Route::get('/comments', [AdminCommentController::class, 'index'])->name('comments.index');
    Route::put('/comments/{comment}/approve', [AdminCommentController::class, 'approve'])->name('comments.approve');
    Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');
});

// Inclusion des routes d'authentification (login, register, etc.) générées par Breeze
require __DIR__.'/auth.php';
