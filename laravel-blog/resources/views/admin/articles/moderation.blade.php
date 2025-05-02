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
@endsection
