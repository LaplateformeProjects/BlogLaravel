@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
<div class="px-4 py-1 mx-auto max-w-7xl">
    <h1 class="relative flex items-center gap-3 mb-8 text-2xl italic font-bold text-blue-700">
        Le Blog de Sophie
        <span class="relative flex w-10 h-10">
            <span class="absolute inset-0 z-0 rounded-full animate-color-pulse"></span>
            <img src="storage/articles/ampoule (1).png" alt="Lire" class="relative z-10 w-10 h-8 " />
        </span>
    </h1>

    @auth        
        <a href="{{ route('articles.create') }}"
            class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-700">
            + Ajouter votre article
        </a>   
    @endauth

    {{-- Formulaire de filtre par catégorie --}}
    <form method="GET" action="{{ route('articles.index') }}" class="mb-6 text-center">
        <div class="relative inline-block w-full sm:w-80 group">
            {{-- Menu déroulant stylé avec glow et fond animé --}}
            <select name="category" onchange="this.form.submit()"
                class="w-full px-4 py-3 pr-10 font-medium text-gray-700 transition-all duration-500 ease-in-out border-2 border-transparent shadow-lg appearance-none rounded-2xl focus:outline-none focus:ring-4 focus:ring-blue-400 hover:ring-2 hover:ring-indigo-300 bg-gradient-to-r from-white via-white to-white hover:from-blue-50 hover:via-indigo-50 hover:to-purple-50 focus:bg-gradient-to-r focus:from-indigo-100 focus:to-blue-100">
                <option value="">Toutes les catégories</option>
                @foreach(\App\Models\Category::all() as $category)
                    <option value="{{ $category->slug }}" {{ request('category') === $category->slug ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            {{-- Chevron animé --}}
            <div class="absolute inset-y-0 flex items-center text-gray-500 transition-transform duration-300 ease-in-out pointer-events-none right-3 group-focus-within:rotate-180">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
        </div>
    </form>

    {{-- Liste des articles --}}
    <div class="grid grid-cols-1 gap-6 mt-8 sm:grid-cols-2 lg:grid-cols-3">
        @foreach($articles as $article)
            <div class="p-6 transition duration-300 bg-white shadow rounded-2xl hover:shadow-lg">
                
                {{-- Image de l’article --}} 
                @php
                    $isPlaceholder = !$article->image || !file_exists(public_path('storage/' . $article->image));
                    $imagePath = $isPlaceholder
                        ? asset('storage/articles/placeholder.png')
                        : asset('storage/' . $article->image);
                @endphp

                <div class="relative w-full mb-4 overflow-hidden rounded-xl aspect-[4/3] bg-gradient-to-br from-indigo-100 via-white to-purple-100 shadow-lg group">
                    <img src="{{ $imagePath }}"
                        alt="{{ $article->title }}"
                        loading="lazy"
                        class="object-cover w-full h-full transition duration-500 transform hover:scale-105 hover:brightness-110 {{ $isPlaceholder ? 'blur-sm brightness-90' : '' }}" />

                    @if($isPlaceholder)
                        {{-- Overlay avec icône 📷 --}}
                        <div class="absolute inset-0 flex items-center justify-center text-3xl text-white bg-black bg-opacity-50 rounded-lg">
                            📷
                        </div>

                        {{-- Label en bas à droite --}}
                        <span class="absolute bottom-2 right-2 px-2 py-0.5 text-[11px] bg-gray-800 text-white rounded-full opacity-80">
                            Image par défaut
                        </span>
                    @endif

                    {{-- Effet de bordure animé --}}
                    <div class="absolute inset-0 pointer-events-none rounded-xl ring-2 ring-indigo-300/20 group-hover:ring-indigo-500/40 animate-pulse"></div>
                </div>

                {{-- Badge de catégorie --}} 
                <span class="inline-block px-3 py-1 mb-2 rounded-full text-xs font-semibold text-white
                    @switch($article->category->slug)
                        @case('technologie') bg-blue-500 @break
                        @case('voyage') bg-emerald-500 @break
                        @case('sante') bg-pink-500 @break
                        @default bg-gray-500
                    @endswitch
                ">
                    {{ $article->category->name }}
                </span>

                {{-- Titre de l’article --}} 
                <a href="{{ route('articles.show', $article->slug) }}" class="block mb-2 text-xl font-bold text-gray-900 hover:text-indigo-600">
                    {{ $article->title }}
                </a>

                {{-- Extrait de l’article --}} 
                <p class="mb-4 text-sm text-gray-700">
                    {{ Str::limit($article->body, 100) }}
                </p>

                {{-- Date et Auteur --}} 
                <p class="text-xs text-gray-500">
                    Publié le {{ $article->created_at->format('d M Y') }} - par {{ $article->user->name ?? 'Auteur inconnu' }}
                </p>

            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="mt-10">
        {{ $articles->links() }}
    </div>
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
