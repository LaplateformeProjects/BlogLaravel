<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Article;
use App\Models\Category;
use App\Models\Comment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Comptes généraux
        $users = User::all();
        $userCount = User::count();
        $articlesCount = Article::count();
        $pendingArticles = Article::where('approved', false)->count();
        $pendingComments = Comment::where('approved', false)->count();
        $users = User::where('is_admin', 0)->orderBy('created_at', 'desc')->get();

        // Mois pour les graphiques
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create()->month($month)->locale('fr_FR')->translatedFormat('F');
        });

        // Articles créés par mois
        $articlesPerMonth = collect(range(1, 12))->map(function ($month) {
            return Article::whereMonth('created_at', $month)->count();
        });

        // Récupère toutes les catégories avec le nombre d'articles associés
        $categories = Category::withCount('articles')->get();

        // Utilisateurs enregistrés par mois
        $usersPerMonth = collect(range(1, 12))->map(function ($month) {
            return User::whereMonth('created_at', $month)->count();
        });

        // Retourner la vue avec les données nécessaires
        return view('admin.dashboard', compact(
            'articlesCount',
            'pendingArticles',
            'pendingComments',
            'userCount',
            'months',
            'articlesPerMonth',
            'categories',
            'usersPerMonth',
            'users'
        ));
    }
}
