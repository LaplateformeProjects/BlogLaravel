@extends('layouts.admin')

@section('title', 'Modifier l\'article')

@section('content')
<div class="max-w-3xl px-4 py-10 mx-auto">
    <h1 class="mb-6 text-2xl font-bold">Modifier l'article</h1>

    <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('PUT')

        <div>
            <label class="block mb-1 font-medium">Titre</label>
            <input type="text" name="title" class="w-full border-gray-300 rounded-md" value="{{ old('title', $article->title) }}">
            @error('title') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Slug</label>
            <input type="text" name="slug" class="w-full border-gray-300 rounded-md" value="{{ old('slug', $article->slug) }}">
            @error('slug') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Catégorie</label>
            <select name="category_id" class="w-full border-gray-300 rounded-md">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $article->category_id) == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Image actuelle</label>
            @if($article->image)
                <img src="{{ asset('storage/' . $article->image) }}" alt="image" class="w-full max-w-xs mb-2 rounded-md shadow">
            @endif
            <input type="file" name="image" class="w-full border-gray-300 rounded-md">
            @error('image') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
        </div>

        <div>
            <label class="block mb-1 font-medium">Contenu</label>
            <textarea name="body" rows="6" class="w-full border-gray-300 rounded-md">{{ old('body', $article->body) }}</textarea>
            @error('body') <div class="text-sm text-red-600">{{ $message }}</div> @enderror
        </div>

        <button type="submit" class="px-4 py-2 text-white bg-yellow-600 rounded hover:bg-yellow-700">Mettre à jour</button>
    </form>
</div>
@endsection
