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

<h2 class="text-2xl font-semibold mb-6">
    Articles dans la catégorie <span class="text-indigo-600">"{{ $category->name }}"</span>
</h2>

<!-- Grille d’articles stylée -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($articles as $article)
        <div class="bg-white rounded-2xl shadow p-4 hover:shadow-lg transition duration-300">
            
            {{-- Image d’en-tête --}}
            @if($article->image)
                <img src="{{ asset('storage/' . $article->image) }}"
                     alt="{{ $article->title }}"
                     class="w-full h-40 object-cover rounded-xl mb-3">
            @endif

            {{-- Badge catégorie --}}
            <span class="inline-block px-3 py-1 mb-2 rounded-full text-xs font-semibold text-white
                @switch($article->category->slug)
                    @case('technologie') bg-blue-500 @break
                    @case('voyage') bg-emerald-500 @break
                    @case('sante') bg-pink-500 @break
                    @default bg-gray-500
                @endswitch
            ">
                {{ $article->category->name }}
            </span>

            {{-- Titre --}}
            <h3 class="text-xl font-bold">
                <a href="{{ route('articles.show', $article->slug) }}"
                   class="text-gray-800 hover:text-indigo-600 hover:underline">
                    {{ $article->title }}
                </a>
            </h3>

            {{-- Date --}}
            <p class="text-sm text-gray-500 mt-1">
                Publié le {{ $article->created_at->format('d M Y') }}
            </p>
        </div>
    @endforeach
</div>

<!-- Pagination -->
<div class="mt-6">
    {{ $articles->links() }}
</div>

@endsection
