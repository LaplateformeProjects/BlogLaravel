<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
{
    // Champs assignables
    protected $fillable = ['name', 'slug'];

    protected static function booted()
    {
    static::addGlobalScope('ordered', function (Builder $builder) {
        $builder->orderBy('name','asc');
    });
    }

    // Relation : une catégorie a plusieurs articles
    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    /**
     * Scope pour trier les catégories.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  string  $column     Colonne à trier (par défaut "name")
     * @param  string  $direction  "asc" ou "desc" (par défaut "asc")
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeOrdered($query, $column = 'name', $direction = 'asc')
    {
        return $query->orderBy($column, $direction);
    }
}
