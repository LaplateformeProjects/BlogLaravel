<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Champs assignables
    protected $fillable = ['name', 'slug'];

    // Relation : une catégorie a plusieurs articles
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
}
