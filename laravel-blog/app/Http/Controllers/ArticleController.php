<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    // Affiche la liste de tous les articles (page d'accueil) avec filtre par catégorie et/ou mots clés
    public function index(Request $request)
    {
        $query = Article::query()
            ->join('categories', 'articles.category_id', '=', 'categories.id')
            ->select('articles.*')
            ->with('category')
            ->orderByRaw("
                CASE categories.slug
                    WHEN 'voyage' THEN 1
                    WHEN 'technologie' THEN 2
                    WHEN 'sante' THEN 3
                    ELSE 4
                END
            ");

        // Filtrage par catégories
        if ($request->filled('category')) {
            $query->where('categories.slug', $request->category);
        }

        // Filtrage par mots-clés
        if ($request->filled('keywords')) {
            $keywords = $request->keywords;

            $query->where(function ($q) use ($keywords) {
                $q->where('articles.title', 'like', "%{$keywords}%")
                ->orWhere('articles.slug', 'like', "%{$keywords}%")
                ->orWhere('articles.body', 'like', "%{$keywords}%");
            });
        }

        $articles = $query->paginate(9);

        return view('articles.index', compact('articles'));
    }

    // Affiche le détail d'un seul article via son slug
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('articles.show', compact('article'));
    }

    // Recherche d’articles via une requête textuelle
    public function search(Request $request)
    {
        $query = $request->input('query');

        $articles = Article::where('title', 'like', "%{$query}%")
            ->orWhere('body', 'like', "%{$query}%")
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('articles.index', compact('articles'));
    }

    // Filtrage via URL par slug de catégorie (si besoin pour une page dédiée)
    public function filterByCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $articles = Article::query()
            ->join('categories', 'articles.category_id', '=', 'categories.id')
            ->where('categories.slug', $slug)
            ->orderByRaw("FIELD(categories.slug, 'sante', 'technologie', 'voyage')")
            ->select('articles.*')
            ->with('category')
            ->paginate(10);

        return view('category.show', compact('category', 'articles'));
    }

    // Afficher le formulaire
    public function create()
    {
        $categories = Category::all();

        return view('articles.create', compact('categories'));
    }

    // Stocker l’article rédigé par l’utilisateur
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'required|unique:articles,slug',
            'body'        => 'required',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|max:2048',
        ]);

        // Upload de l’image si fourni
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        // Affecte l’auteur connecté
        $validated['user_id'] = auth()->id();

        // Création de l’article
        Article::create($validated);

        return redirect()
            ->route('articles.index')
            ->with('success', 'Votre article a bien été publié.');
    }
}