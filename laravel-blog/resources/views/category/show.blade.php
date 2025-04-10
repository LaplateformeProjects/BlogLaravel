@extends('layouts.app')

@section('title', $category->name)

@section('content')
<h2 class="text-2xl font-semibold mb-4">
    Articles dans la catégorie "{{ $category->name }}"
</h2>

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
@endsection
