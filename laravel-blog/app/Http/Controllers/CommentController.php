<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        // Validation des champs
        $validated = $request->validate([
            'author' => 'nullable|string|max:255',
            'body'   => 'required|string|min:3',
        ]);

        // Création du commentaire lié à l'article
        $comment = new Comment();
        $comment->article_id = $article->id;
        $comment->author = $validated['author'] ?? null;
        $comment->body = $validated['body'];
        $comment->user_id = auth()->id(); // null si visiteur
        $comment->approved = false; // Non approuvé par défaut
        $comment->save();

        return redirect()
            ->route('articles.show', $article->slug)
            ->with('success', 'Commentaire soumis et en attente de modération.');
    }
}
