<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mon Blog Laravel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css') {{-- si tu utilises Vite --}}
</head>
<body class="bg-gray-100 text-gray-900">
    <div class="max-w-4xl mx-auto p-4">
    <header class="mb-6">
    <h1 class="text-3xl font-bold text-center">📰 Mon Blog Laravel</h1>
    <nav class="mt-4 text-center">
        <a href="{{ route('articles.index') }}" class="text-blue-600 hover:underline">Accueil</a>
    </nav>

    <!-- Menu de catégories -->
    <div class="mt-4 text-center">
        <select onchange="window.location.href=this.value" class="border p-2 rounded">
            <option value="{{ route('articles.index') }}">Toutes les catégories</option>
            @foreach(\App\Models\Category::all() as $category)
                <option value="{{ route('category.show', $category->slug) }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Formulaire de recherche -->
    <div class="mt-4 text-center">
        <form action="{{ route('articles.search') }}" method="GET" class="inline-flex items-center">
            <input type="text" name="query" placeholder="Par article..." class="border p-2 rounded-l-md w-1/2">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-r-md hover:bg-blue-700">Rechercher</button>
        </form>
    </div>
</header>


        <main>
            @yield('content')
        </main>

        <footer class="mt-10 border-t pt-4 text-sm text-center text-gray-500">
            © {{ date('Y') }} - Blog Laravel - Tous droits réservés.
        </footer>
    </div>
</body>
</html>
