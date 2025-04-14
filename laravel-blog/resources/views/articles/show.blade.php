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
@endsection
