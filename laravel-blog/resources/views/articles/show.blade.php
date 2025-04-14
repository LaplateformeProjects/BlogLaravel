@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-8">
    {{-- Image principale --}}
    @if($article->image)
        <img src="{{ asset('storage/' . $article->image) }}"
             alt="{{ $article->title }}"
             class="w-full h-64 object-cover rounded-xl shadow mb-6">
    @endif

    {{-- Badge catégorie --}}
    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold text-white bg-indigo-500 mb-4">
        {{ $article->category->name }}
    </span>

    {{-- Titre --}}
    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $article->title }}</h1>

    {{-- Contenu --}}
    <div class="text-gray-700 leading-relaxed space-y-4">
        {!! nl2br(e($article->body)) !!}
    </div>
</div>
@endsection
