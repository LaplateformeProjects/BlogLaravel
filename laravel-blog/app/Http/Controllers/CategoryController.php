<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;

class CategoryController extends Controller
{
    // Affiche tous les articles d'une catégorie donnée (via slug)
    public function show($slug)
    {
        // Récupération de la catégorie sélectionnée
        $category = Category::where('slug', $slug)->firstOrFail();

        // Liste des catégories triées alphabétiquement (scope ou global scope)
        $categories = Category::ordered()->get();

        // Récupération des articles de la catégorie courante, triés par ordre de nom de catégorie
        // On fait une jointure SQL pour ordonner selon categories.name
        $articles = Article::query()
            ->join('categories', 'articles.category_id', '=', 'categories.id')
            ->where('categories.slug', $slug)
            ->orderByRaw("FIELD(categories.slug, 'sante','technologie','voyage')")
            ->select('articles.*')
            ->with('category')
            ->paginate(10);

        return view('category.show', compact('category', 'articles', 'categories'));
    }

    // Création depuis le dashboard admin
    public function store(Request $request)
    {
         $request->validate([
             'name' => 'required|unique:categories|max:255'
         ]);
 
         Category::create([
             'name' => $request->name,
             'slug' => Str::slug($request->name)
         ]);
 
        return redirect()->route('admin.dashboard')->with('success', 'Catégorie ajoutée avec succès.');
    }
 
    // Suppression depuis le dashboard admin
    public function destroy(Category $category)
    {
        if ($category->articles()->count() > 0) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Impossible de supprimer cette catégorie car elle contient des articles.');
        }

        $category->delete();

        return redirect()
            ->route('admin.dashboard')
            ->with('deleted', 'Catégorie supprimée avec succès.');
    }

    // Mise à jour depuis le dashboard admin
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'La catégorie a été mise à jour avec succès.');
    }
}