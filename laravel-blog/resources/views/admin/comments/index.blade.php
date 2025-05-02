@extends('layouts.admin')

@section('title', 'Modération des commentaires')

@section('content')
<div class="max-w-6xl px-4 py-8 mx-auto">
    <h1 class="mb-6 text-2xl font-bold">Modération des commentaires</h1>

    {{-- Notification flash --}}
    @if(session('success'))
        <div class="px-4 py-3 mb-4 text-green-800 bg-green-100 border border-green-300 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Ancienne boucle de commentaires --}}
    @foreach($comments as $comment)
        <div class="p-4 mb-4 bg-white border border-gray-200 rounded shadow">
            <p class="text-sm text-gray-500">
                <strong>{{ $comment->author ?? $comment->user->name ?? 'Anonyme' }}</strong> sur 
                <em>{{ $comment->article->title }}</em> – 
                {{ $comment->created_at->format('d/m/Y H:i') }}
            </p>
            <p class="mt-2 text-gray-800">{{ $comment->body }}</p>

            <div class="flex mt-4 space-x-3">
                @if(!$comment->approved)
                    <form action="{{ route('admin.comments.approve', $comment) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="px-3 py-1 text-white bg-green-500 rounded hover:bg-green-700">Approuver</button>
                    </form>
                @else
                    <span class="px-3 py-1 text-sm text-green-700 bg-green-100 rounded">Approuvé</span>
                @endif

                <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Supprimer ce commentaire ?')">
                    @csrf
                    @method('DELETE')
                    <button class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-700">Supprimer</button>
                </form>
            </div>
        </div>
    @endforeach

    {{-- Autre style de liste (optionnel ou complémentaire) --}}
    @if($comments->isEmpty())
        <p class="text-gray-600">Aucun commentaire à afficher.</p>
    @endif
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
