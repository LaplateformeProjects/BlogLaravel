@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">📰 Tous les articles</h1>

    {{-- Formulaire de filtre par catégorie --}}
    <form method="GET" action="{{ route('articles.index') }}" class="mb-6 text-center">
        <select name="category" onchange="this.form.submit()" class="border border-gray-300 p-2 rounded shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
            <option value="">Toutes les catégories</option>
            @foreach(\App\Models\Category::all() as $category)
                <option value="{{ $category->slug }}" {{ request('category') === $category->slug ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </form>

    {{-- Liste des articles --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
        @foreach($articles as $article)
            <div class="bg-white rounded-2xl shadow p-6 hover:shadow-lg transition duration-300">
                
                {{-- Image de l’article --}} 
                @if($article->image) 
                    <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}"
                         class="w-full h-40 object-cover rounded-lg mb-4">
                @endif

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
                <a href="{{ route('articles.show', $article->slug) }}" class="text-xl font-bold text-gray-900 hover:text-indigo-600 block mb-2">
                    {{ $article->title }}
                </a>

                {{-- Extrait de l’article --}} 
                <p class="text-sm text-gray-700 mb-4">
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
