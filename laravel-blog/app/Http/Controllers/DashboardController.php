<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Article;
use App\Models\Comment;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // Comptes généraux
        $articlesCount = Article::count();
        $pendingComments = Comment::where('approved', false)->count();
        $userCount = User::count();

        // Mois pour les graphiques
        $months = collect(range(1, 12))->map(function ($month) {
            return Carbon::create()->month($month)->locale('fr_FR')->translatedFormat('F');
        });

        // Articles créés par mois
        $articlesPerMonth = collect(range(1, 12))->map(function ($month) {
            return Article::whereMonth('created_at', $month)->count();
        });

        // Retourner la vue avec les données nécessaires
        return view('admin.dashboard', compact(
            'articlesCount',
            'pendingComments',
            'userCount',
            'months',
            'articlesPerMonth'
        ));
    }
}
