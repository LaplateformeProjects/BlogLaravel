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
        <nav class="bg-blue-600 text-white px-6 py-4 rounded-xl shadow-md">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <!-- Logo -->
                <div class="flex items-center gap-2 text-xl font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 10l9-7 9 7v10a2 2 0 01-2 2h-4a2 2 0 01-2-2v-4H9v4a2 2 0 01-2 2H5a2 2 0 01-2-2V10z"/>
                    </svg>
                    <span>Mon Blog</span>
                </div>

                <!-- Liens principaux -->
                <div class="flex gap-6 text-sm font-medium items-center">
                    <a href="{{ route('articles.index') }}" class="hover:underline hover:text-gray-200 transition">Accueil</a>
                    
                    <!-- Dropdown Catégories -->
                    <div class="relative group">
                        <button class="hover:underline hover:text-gray-200 transition flex items-center gap-1">
                            Catégories
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2"
                                 viewBox="0 0 24 24">
                                <path d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 bg-white text-gray-800 rounded-lg shadow-lg min-w-[160px]
                                    opacity-0 group-hover:opacity-100 transition-opacity duration-200 z-50 invisible group-hover:visible">
                            @foreach(\App\Models\Category::all() as $category)
                                <a href="{{ route('category.show', $category->slug) }}"
                                   class="block px-4 py-2 hover:bg-gray-100">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <a href="#" class="hover:underline hover:text-gray-200 transition">À propos</a>
                    <a href="#" class="hover:underline hover:text-gray-200 transition">Contact</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-blue-600 text-white px-6 py-3 mt-10 rounded-xl flex items-center justify-center shadow-md">
        © {{ date('Y') }} - Blog Laravel - Tous droits réservés.
    </footer>
</div>
</body>
</html>
