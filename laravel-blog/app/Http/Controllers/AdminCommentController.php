<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Notifications\CommentApproved;

class AdminCommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with('article')->latest()->get();
        return view('admin.comments.index', compact('comments'));
    }

    public function approve(Comment $comment)
    {
        $comment->approved = true;
        $comment->save();

        // Envoi une notification à l'auteur s'il est un utilisateur enregistré
        if ($comment->user) {
            $comment->user->notify(new CommentApproved($comment));
        }

        return redirect()->back()->with('success', 'Commentaire approuvé.');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Commentaire supprimé.');
    }
}
