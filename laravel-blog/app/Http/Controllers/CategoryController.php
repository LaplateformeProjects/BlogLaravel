<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Affiche tous les articles d'une catégorie donnée (via slug)
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        // Récupération des articles avec leur catégorie
        $articles = $category->articles()
            ->with('category')
            ->orderByDesc('created_at')
            ->paginate(10);

        // Toutes les catégories pour affichage dans la vue
        $categories = Category::all();

        return view('category.show', compact('category', 'articles', 'categories'));
    }
}
