@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="max-w-4xl px-4 py-8 mx-auto">

    {{-- Image de l’article --}}
    @php
        $imagePath = $article->image ? asset('storage/' . $article->image) : asset('images/placeholder.jpg');
    @endphp

    <div class="relative w-full mb-6 overflow-hidden shadow-lg rounded-2xl aspect-video bg-gradient-to-tr from-blue-50 via-white to-indigo-100">
        <img src="{{ $imagePath }}"
            alt="{{ $article->title }}"
            loading="lazy"
            class="object-cover w-full h-full transition duration-500 transform hover:scale-105 hover:brightness-110" />

        <div class="absolute inset-0 pointer-events-none rounded-2xl ring-2 ring-indigo-300/20 animate-pulse"></div>
    </div>

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
    <h1 class="mb-2 text-3xl font-bold text-gray-900">
        {{ $article->title }}
    </h1>

    {{-- Date --}}
    <p class="mb-6 text-sm text-gray-500">
        Publié le {{ $article->created_at->format('d M Y') }}
    </p>

    {{-- Contenu --}}
    <div class="prose max-w-none">
        {!! nl2br(e($article->body)) !!}
    </div>

</div>

@if(session('success'))
    <div class="mb-4 font-semibold text-green-600">
        {{ session('success') }}
    </div>
@endif

{{-- Section Commentaires --}}
    <div class="pt-8 mt-12 border-t">
        <h2 class="mb-4 text-2xl font-bold">Commentaires</h2>
        
        {{-- Liste des commentaires --}}
        @forelse($article->comments as $comment)
            <div class="p-4 mb-4 rounded shadow bg-gray-50">
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
                    <input id="author" name="author" type="text" class="block w-full mt-1 border-gray-300 rounded-md">
                </div>
                <div>
                    <label for="body" class="block text-sm font-medium text-gray-700">Commentaire</label>
                    <textarea id="body" name="body" rows="4" class="block w-full mt-1 border-gray-300 rounded-md"></textarea>
                </div>
                <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    Envoyer
                </button>
            </form>
        </div>
    </div>

@endsection
