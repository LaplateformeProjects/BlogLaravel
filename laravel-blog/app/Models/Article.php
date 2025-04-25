<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;

class Article extends Model
{
    // Champs assignables
    protected $fillable = [
        'title',
        'slug',
        'body',
        'category_id',
        'user_id',
        'image',
    ];

    // L'auteur de l'article
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    //La catégorie de l'article
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    //Tous les commentaires, approuvés ou non
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    //Uniquement les commentaires approuvés
    public function approvedComments(): HasMany
    {
        return $this->hasMany(Comment::class)->where('approved', true);
    }
}
