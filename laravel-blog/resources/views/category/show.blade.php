@extends('layouts.app')

@section('title', $category->name)

@section('content')

<!-- Affichage des catégories dans une grille -->
<div class="grid grid-cols-1 gap-4 mb-8 sm:grid-cols-2 md:grid-cols-3">
    @foreach ($categories as $categoryItem)
        <a href="{{ route('category.show', $categoryItem->slug) }}"
           class="block p-6 transition bg-white shadow rounded-xl hover:shadow-lg">
            <h2 class="text-xl font-semibold text-gray-800">{{ $categoryItem->name }}</h2>
            <p class="mt-1 text-sm text-gray-500">
                {{ $categoryItem->articles->count() }} article(s)
            </p>
        </a>
    @endforeach
</div>

<h2 class="mb-6 text-2xl font-semibold">
    Articles dans la catégorie <span class="text-indigo-600">"{{ $category->name }}"</span>
</h2>

<!-- Grille d’articles stylée -->
<div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
    @foreach($articles as $article)
        <div class="p-4 transition duration-300 bg-white shadow rounded-2xl hover:shadow-lg">

            @php
                $imagePath = $article->image && file_exists(public_path('storage/' . $article->image))
                    ? asset('storage/' . $article->image)
                    : asset('storage/articles/placeholder.png');
                $isPlaceholder = $imagePath === asset('storage/articles/placeholder.png');
            @endphp

            {{-- Image d’en-tête --}}
            <div class="relative w-full mb-3 overflow-hidden rounded-xl aspect-[4/3] bg-gradient-to-br from-indigo-100 via-white to-purple-100 shadow-lg">
                <img src="{{ $imagePath }}"
                     alt="{{ $article->title }}"
                     loading="lazy"
                     class="object-cover w-full h-full transition duration-500 transform hover:scale-105 hover:brightness-110 {{ $isPlaceholder ? 'blur-sm' : '' }}" />

                @if($isPlaceholder)
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-white bg-black bg-opacity-50 rounded-xl">
                        <span class="text-3xl">📷</span>
                    </div>
                    <span class="absolute px-2 py-1 text-xs font-semibold text-white bg-black rounded bottom-2 left-2 bg-opacity-60">
                        Image par défaut
                    </span>
                @endif

                <div class="absolute inset-0 pointer-events-none rounded-xl ring-2 ring-indigo-300/20 group-hover:ring-indigo-500/40 animate-pulse"></div>
            </div>

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
            <p class="mt-1 text-sm text-gray-500">
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
