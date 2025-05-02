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
                class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">
            Publier
        </button>
    </form>
</div>

{{-- Bouton de retour en haut --}}
<div class="fixed z-50 group bottom-6 right-6">
    <button id="scrollToTopBtn"
        class="hidden p-3 text-white transition-all duration-300 transform bg-white rounded-full shadow-lg
               hover:scale-110 hover:shadow-[0_0_15px_4px_rgba(99,102,241,0.4)] animate-pulse"
        aria-label="Retour en haut">
        ⬆️
    </button>

    {{-- Tooltip à gauche avec animation --}}
    <div class="absolute items-center hidden px-3 py-1 mr-3 text-xs font-medium text-white transition-all duration-300 ease-out transform scale-95 -translate-y-1/2 bg-black rounded shadow-md opacity-0 right-full top-1/2 group-hover:flex bg-opacity-80 group-hover:opacity-100 group-hover:scale-100">
        Retour en haut
        <div class="absolute w-2 h-2 rotate-45 -translate-y-1/2 bg-black bg-opacity-80 top-1/2 -right-1"></div>
    </div>
</div>

<script>
    const scrollBtn = document.getElementById('scrollToTopBtn');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 100) {
            scrollBtn.classList.remove('hidden');
        } else {
            scrollBtn.classList.add('hidden');
        }
    });

    scrollBtn.addEventListener('click', () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });
</script>

@endsection
