<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Affiche tous les articles d'une catégorie donnée (via slug)
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        // Récupération des articles avec leur catégorie, triés du plus récent au plus ancien
        $articles = $category->articles()
            ->with('category')
            ->orderByDesc('created_at')
            ->paginate(10);

        // Toutes les catégories pour affichage dans la vue, triées par nom ascendant
        $categories = Category::ordered()->get();

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
