@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">

    {{-- Image d’en-tête --}}
    @if($article->image)
        <img src="{{ asset('storage/' . $article->image) }}"
             alt="{{ $article->title }}"
             class="w-full h-64 object-cover rounded-2xl mb-6 shadow">
    @endif

    {{-- Badge de catégorie --}}
    <span class="inline-block px-4 py-1 rounded-full text-sm font-semibold text-white mb-4
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
    <h1 class="text-3xl font-bold text-gray-900 mb-2">
        {{ $article->title }}
    </h1>

    {{-- Date --}}
    <p class="text-sm text-gray-500 mb-6">
        Publié le {{ $article->created_at->format('d M Y') }}
    </p>

    {{-- Contenu --}}
    <div class="prose max-w-none">
        {!! nl2br(e($article->body)) !!}
    </div>

</div>

@if(session('success'))
    <div class="mb-4 text-green-600 font-semibold">
        {{ session('success') }}
    </div>
@endif

{{-- Section Commentaires --}}
    <div class="mt-12 border-t pt-8">
        <h2 class="text-2xl font-bold mb-4">Commentaires</h2>
        
        {{-- Liste des commentaires --}}
        @forelse($article->comments as $comment)
            <div class="mb-4 p-4 bg-gray-50 rounded shadow">
                <p class="text-sm text-gray-700"><strong>{{ $comment->author ?? 'Anonyme' }} :</strong></p>
                <p class="text-sm text-gray-600">{{ $comment->body }}</p>
            </div>
        @empty
            <p class="text-gray-500">Aucun commentaire pour l’instant.</p>
        @endforelse

        {{-- Formulaire pour ajouter un commentaire --}}
        <div class="mt-6">
            <form action="{{ route('comments.store', $article->id) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="author" class="block text-sm font-medium text-gray-700">Nom</label>
                    <input id="author" name="author" type="text" class="mt-1 block w-full border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="body" class="block text-sm font-medium text-gray-700">Commentaire</label>
                    <textarea id="body" name="body" rows="4" class="mt-1 block w-full border-gray-300 rounded-md"></textarea>
                </div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                    Envoyer
                </button>
            </form>
        </div>
    </div>

@endsection
