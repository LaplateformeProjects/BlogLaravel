@extends('layouts.app')

@section('title', $category->name)

@section('content')

<!-- Affichage des catégories dans une grille -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mb-8">
    @foreach ($categories as $categoryItem)
        <a href="{{ route('category.show', $categoryItem->slug) }}"
           class="block bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <h2 class="text-xl font-semibold text-gray-800">{{ $categoryItem->name }}</h2>
            <p class="text-sm text-gray-500 mt-1">
                {{ $categoryItem->articles->count() }} article(s)
            </p>
        </a>
    @endforeach
</div>

<h2 class="text-2xl font-semibold mb-4">
    Articles dans la catégorie <span class="text-indigo-600">"{{ $category->name }}"</span>
</h2>

<div class="space-y-4">
    @foreach($articles as $article)
        <div class="bg-white p-4 rounded shadow">
            <h3 class="text-xl font-bold">
                <a href="{{ route('articles.show', $article->slug) }}" class="text-blue-600 hover:underline">
                    {{ $article->title }}
                </a>
            </h3>
            <p class="text-sm text-gray-500">
                Catégorie : 
                <a href="{{ route('category.show', $article->category->slug) }}" class="text-indigo-500 hover:underline">
                    {{ $article->category->name }}
                </a>
            </p>
        </div>
    @endforeach
</div>

<div class="mt-6">
    {{ $articles->links() }}
</div>

@endsection
