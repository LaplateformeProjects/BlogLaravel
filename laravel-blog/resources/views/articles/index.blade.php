@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<h2 class="text-2xl font-semibold mb-4">
    @isset($query)
        Résultats pour "{{ $query }}" :
    @else
        Tous les articles
    @endisset
</h2>

@if($articles->count())
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
@else
    <p>Aucun article trouvé pour ce mot-clé.</p>
@endif
@endsection
