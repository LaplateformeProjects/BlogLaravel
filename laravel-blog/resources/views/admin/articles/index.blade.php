@extends('layouts.admin')

@section('title', 'Gestion des articles')

@section('content')
<div class="max-w-6xl px-4 py-10 mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Articles</h1>
        <a href="{{ route('admin.articles.create') }}" class="px-4 py-2 text-white bg-blue-600 rounded hover:bg-blue-700">
            + Nouvel Article
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 font-semibold text-green-600">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white rounded-lg shadow">
        <table class="w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 text-left">Titre</th>
                    <th class="px-4 py-2 text-left">Catégorie</th>
                    <th class="px-4 py-2 text-left">Publié le</th>
                    <th class="px-4 py-2 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($articles as $article)
                    <tr class="border-t">
                        <td class="px-4 py-2">{{ $article->title }}</td>
                        <td class="px-4 py-2">{{ $article->category->name }}</td>
                        <td class="px-4 py-2">{{ $article->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-2 space-x-2 text-right">
                            <a href="{{ route('admin.articles.edit', $article) }}" class="text-blue-600 hover:underline">Éditer</a>
                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline-block" onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:underline">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $articles->links() }}
    </div>
</div>
@endsection
