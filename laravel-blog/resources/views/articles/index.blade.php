@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="px-4 py-8 mx-auto max-w-7xl">
    <h1 class="mb-8 text-3xl font-bold">📰 Tous les articles</h1>

    {{-- Formulaire de filtre par catégorie --}}
<form method="GET" action="{{ route('articles.index') }}" class="mb-6 text-center">
    <div class="relative inline-block w-full sm:w-80 group">
        {{-- Menu déroulant stylé avec glow et fond animé --}}
        <select name="category" onchange="this.form.submit()"
            class="w-full px-4 py-3 pr-10 font-medium text-gray-700 transition-all duration-500 ease-in-out border-2 border-transparent shadow-lg appearance-none rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-400 hover:ring-2 hover:ring-indigo-300 bg-gradient-to-r from-white via-white to-white hover:from-blue-50 hover:via-indigo-50 hover:to-purple-50 focus:bg-gradient-to-r focus:from-indigo-100 focus:to-blue-100">
            <option value="">Toutes les catégories</option>
            @foreach(\App\Models\Category::all() as $category)
                <option value="{{ $category->slug }}" {{ request('category') === $category->slug ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        {{-- Chevron animé --}}
        <div class="absolute inset-y-0 flex items-center text-gray-500 transition-transform duration-300 ease-in-out pointer-events-none right-3 group-focus-within:rotate-180">
            <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </div>
</form>


    {{-- Liste des articles --}}
    <div class="grid grid-cols-1 gap-6 mt-8 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($articles as $article)
            <div class="p-6 transition duration-300 bg-white shadow rounded-2xl hover:shadow-lg">
                
            {{-- Image de l’article --}} 
            @php
                $imagePath = $article->image ? asset('storage/' . $article->image) : asset('images/placeholder.jpg');
            @endphp

            <div class="relative w-full mb-4 overflow-hidden rounded-xl aspect-[4/3] bg-gradient-to-br from-indigo-100 via-white to-purple-100 shadow-lg">
                <img src="{{ $imagePath }}"
                    alt="{{ $article->title }}"
                    loading="lazy"
                    class="object-cover w-full h-full transition duration-500 transform hover:scale-105 hover:brightness-110" />
    
                <div class="absolute inset-0 pointer-events-none rounded-xl ring-2 ring-indigo-300/20 group-hover:ring-indigo-500/40 animate-pulse"></div>
            </div>

                {{-- Badge de catégorie --}} 
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

                {{-- Titre de l’article --}} 
                <a href="{{ route('articles.show', $article->slug) }}" class="block mb-2 text-xl font-bold text-gray-900 hover:text-indigo-600">
                    {{ $article->title }}
                </a>

                {{-- Extrait de l’article --}} 
                <p class="mb-4 text-sm text-gray-700">
                    {{ Str::limit($article->body, 100) }}
                </p>

                {{-- Date --}} 
                <p class="text-xs text-gray-500">
                    Publié le {{ $article->created_at->format('d M Y') }}
                </p>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-10">
        {{ $articles->links() }}
    </div>
</div>
@endsection
