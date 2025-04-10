@extends('layouts.app')

@section('title', $article->title)

@section('content')
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-3xl font-bold mb-2">{{ $article->title }}</h2>
    <p class="text-sm text-gray-500 mb-4">
        Catégorie :
        <a href="{{ route('category.show', $article->category->slug) }}" class="text-indigo-500 hover:underline">
            {{ $article->category->name }}
        </a>
    </p>
    <div class="prose">
        {!! nl2br(e($article->body)) !!}
    </div>
</div>
@endsection
