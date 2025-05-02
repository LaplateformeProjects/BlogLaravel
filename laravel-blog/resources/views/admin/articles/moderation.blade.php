@extends('layouts.admin')

@section('title', 'Modération des articles')

@section('content')
<div class="max-w-6xl px-4 py-8 mx-auto">
    <h1 class="mb-6 text-2xl font-bold">Modération des articles</h1>

    {{-- Notification flash --}}
    @if(session('success'))
        <div class="px-4 py-3 mb-4 text-green-800 bg-green-100 border border-green-300 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Liste des articles en attente --}}
    @forelse($articles as $article)
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded shadow">
            <p class="text-sm text-gray-500">
                Proposé par <strong>{{ $article->user->name ?? 'Utilisateur inconnu' }}</strong> — 
                Catégorie : <em>{{ $article->category->name }}</em> — 
                Publié le {{ $article->created_at->format('d/m/Y H:i') }}
            </p>
            <h2 class="mt-2 text-lg font-semibold">{{ $article->title }}</h2>
            <p class="mt-2 text-gray-800">{{ Str::limit($article->body, 300) }}</p>

            <div class="flex mt-4 space-x-3">
                <form action="{{ route('admin.articles.approve', $article) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button class="px-3 py-1 text-white bg-green-500 rounded hover:bg-green-600">Approuver</button>
                </form>

                <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Supprimer cet article ?')">
                    @csrf
                    @method('DELETE')
                    <button class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600">Supprimer</button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-gray-600">Aucun article en attente de modération.</p>
    @endforelse
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
