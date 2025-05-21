<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminArticleController;
use App\Http\Controllers\AdminCommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

// Routes pour la partie publique du blog
Route::get('/', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/search', [ArticleController::class, 'search'])->name('articles.search');

// Routes pour les auteurs authentifiés (hors admin)
Route::middleware('auth')->group(function () {
    // Formulaire de création pour un auteur authentifié
    Route::get('/articles/create', [ArticleController::class, 'create'])
         ->name('articles.create');

    // Enregistrement de l’article par l’auteur
    Route::post('/articles', [ArticleController::class, 'store'])
         ->name('articles.store');
});

// Route de détail d’un article (slug)
Route::get('/article/{slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/categorie/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::post('/article/{article}/comments', [CommentController::class, 'store'])->name('comments.store');

// Routes pour la partie Admin du blog
Route::middleware(['auth', 'is_admin'])
     ->prefix('admin')
     ->name('admin.')
     ->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/articles', [AdminArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [AdminArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [AdminArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/moderation', [AdminArticleController::class, 'moderation'])->name('articles.moderation');
    Route::put('/articles/{article}/approve', [AdminArticleController::class, 'approve'])->name('articles.approve');
    Route::get('/articles/{article}/edit', [AdminArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [AdminArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [AdminArticleController::class, 'destroy'])->name('articles.destroy');
    
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');

    Route::get('/comments', [AdminCommentController::class, 'index'])->name('comments.index');
    Route::put('/comments/{comment}/approve', [AdminCommentController::class, 'approve'])->name('comments.approve');
    Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');
});

// Pages statiques 
Route::view('/cgu', 'cgu')->name('cgu');
Route::view('/about', 'about')->name('about');
Route::view('/confidentiality', 'confidentiality')->name('confidentiality');

// Route pour afficher le formulaire de contact
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
// Route pour envoyer le formulaire de contact
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Afficher le formulaire de modification de profil
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
// Mettre à jour les infos de profil
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
// Supprimer le compte
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Inclusion des routes d'authentification (login, register, etc.) générées par Breeze
require __DIR__.'/auth.php';
