<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Affiche la liste de tous les articles (page d'accueil)
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->paginate(5);
        return view('articles.index', compact('articles'));
    }

    // Affiche le détail d'un seul article via son slug
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('articles.show', compact('article'));
    }

    public function search(Request $request)
{
    $query = $request->input('query');
    
    // Rechercher dans les titres et le contenu des articles
    $articles = Article::where('title', 'like', "%{$query}%")
        ->orWhere('body', 'like', "%{$query}%")
        ->orderBy('created_at', 'desc')
        ->paginate(10);

    return view('articles.index', compact('articles'));
}

    public function filterByCategory($slug)
{
    // Trouver la catégorie par son slug
    $category = \App\Models\Category::where('slug', $slug)->firstOrFail();
    
    // Récupérer les articles associés à cette catégorie
    $articles = $category->articles()->orderBy('created_at', 'desc')->paginate(5);

    return view('category.show', compact('category', 'articles'));
}

}
