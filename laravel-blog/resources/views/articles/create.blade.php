@extends('layouts.app')

@section('content')
<div class="max-w-3xl py-10 mx-auto">
    <h1 class="mb-6 text-2xl font-bold">Nouvel article</h1>

    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Titre --}}
        <div>
            <label class="block mb-1">Titre</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full border-gray-300 rounded">
            @error('title') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- Slug --}}
        <div>
            <label class="block mb-1">Slug</label>
            <input type="text" name="slug" value="{{ old('slug') }}" class="w-full border-gray-300 rounded">
            @error('slug') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- Catégorie --}}
        <div>
            <label class="block mb-1">Catégorie</label>
            <select name="category_id" class="w-full border-gray-300 rounded">
                <option value="">-- Choisir --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(old('category_id') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- Image --}}
        <div>
            <label class="block mb-1">Image</label>
            <input type="file" name="image" class="w-full">
            @error('image') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        {{-- Corps de l’article --}}
        <div>
            <label class="block mb-1">Contenu</label>
            <textarea name="body" rows="6" class="w-full border-gray-300 rounded">{{ old('body') }}</textarea>
            @error('body') <p class="text-red-600">{{ $message }}</p> @enderror
        </div>

        <button type="submit"
                class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            Publier
        </button>
    </form>
</div>
@endsection
