@extends('layouts.admin')

@section('title', 'Modération des commentaires')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-6">Modération des commentaires</h1>

    {{-- Notification flash --}}
    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Ancienne boucle de commentaires --}}
    @foreach($comments as $comment)
        <div class="bg-white p-4 rounded shadow mb-4 border border-gray-200">
            <p class="text-sm text-gray-500">
                <strong>{{ $comment->author ?? $comment->user->name ?? 'Anonyme' }}</strong> sur 
                <em>{{ $comment->article->title }}</em> – 
                {{ $comment->created_at->format('d/m/Y H:i') }}
            </p>
            <p class="mt-2 text-gray-800">{{ $comment->body }}</p>

            <div class="mt-4 flex space-x-3">
                @if(!$comment->approved)
                    <form action="{{ route('admin.comments.approve', $comment) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Approuver</button>
                    </form>
                @else
                    <span class="bg-green-100 text-green-800 text-sm px-3 py-1 rounded">Approuvé</span>
                @endif

                <form action="{{ route('admin.comments.destroy', $comment) }}" method="POST" onsubmit="return confirm('Supprimer ce commentaire ?')">
                    @csrf
                    @method('DELETE')
                    <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Supprimer</button>
                </form>
            </div>
        </div>
    @endforeach

    {{-- Autre style de liste (optionnel ou complémentaire) --}}
    @if($comments->isEmpty())
        <p class="text-gray-600">Aucun commentaire à afficher.</p>
    @endif
</div>
@endsection
