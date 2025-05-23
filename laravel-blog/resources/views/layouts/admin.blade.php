<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Espace Admin - Mon Blog')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <!-- Tu peux ajouter ici d'autres styles spécifiques si nécessaire -->
</head>
<body class="text-gray-900 bg-gray-200">
    <!-- Navbar héritée de layouts/app.blade.php -->
    <nav class="fixed inset-x-0 top-0 z-50 bg-white shadow-md" x-data="{ open: false }">
        <div class="flex items-center justify-between px-4 py-3 mx-auto max-w-7xl">
            <a href="/" class="transition-transform duration-300 hover:scale-110 group">
                <img src="{{ asset('storage/articles/logo.png') }}" 
                     alt="Logo" 
                     class="w-auto h-16 transition duration-500 ease-in-out group-hover:filter group-hover:hue-rotate-15 group-hover:saturate-150 group-hover:brightness-110">
            </a>

            <!-- Menu burger -->
            <div class="sm:hidden">
                <button @click="open = !open" class="text-gray-600 focus:outline-none">
                    <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                    <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Liens desktop -->
            <div class="items-center hidden space-x-4 sm:flex">
                @auth
                    @if(Auth::user()->is_admin ?? false)
                        <a href="{{ route('admin.dashboard') }}" class="text-green-500 hover:text-green-800 hover:underline">Dashboard-Admin</a>
                    @endif
                    <span class="font-semibold text-gray-600">Bonjour, {{ Auth::user()->name }}</span>

                    <!-- Nouveau lien pour les auteurs -->
                    <a href="{{ route('articles.create') }}"
                       class="text-blue-500 hover:text-blue-800 hover:underline">
                        Créer un article
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-800 hover:underline">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-800 hover:underline">Connexion</a>
                    <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-800 hover:underline">Inscription</a>
                @endauth
            </div>
        </div>

        <!-- Menu mobile -->
        <div class="px-4 pt-2 pb-4 space-y-2 sm:hidden" x-show="open" style="display: none;">
            @auth
                @if(Auth::user()->is_admin ?? false)
                    <a href="{{ route('admin.articles.index') }}" class="block text-green-500 hover:text-green-800">Retour Dashboard</a>
                @endif
                <div class="font-semibold text-gray-600">Bonjour, {{ Auth::user()->name }}</div>

                <!-- Nouveau lien mobile -->
                <a href="{{ route('articles.create') }}"
                   class="block text-blue-500 hover:text-blue-800">
                    Créer un article
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-800">Déconnexion</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block text-blue-500 hover:text-blue-800">Connexion</a>
                <a href="{{ route('register') }}" class="block text-blue-500 hover:text-blue-800">Inscription</a>
            @endauth
        </div>
    </nav>

    <div class="flex flex-col min-h-screen pt-24">

        <!-- Contenu principal Admin -->
        <div class="flex flex-1">
            <!-- Sidebar modernisée -->
            <aside class="hidden w-64 p-6 bg-white border-r border-gray-200 shadow-lg md:block">
                <nav class="space-y-6">
                    <!-- Groupe 1 : Gestion des articles -->
                    <div>
                        <h2 class="mb-2 text-xs font-bold tracking-wide text-gray-800 uppercase">Articles</h2>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('admin.articles.create') }}" class="block px-4 py-2 text-gray-700 transition rounded-lg hover:bg-gray-100 hover:text-indigo-600">
                                Ajouter un article
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.articles.index') }}" class="block px-4 py-2 text-gray-700 transition rounded-lg hover:bg-gray-100 hover:text-indigo-600">
                                Gérer les articles
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('admin.articles.moderation') }}" class="block px-4 py-2 text-gray-700 transition rounded-lg hover:bg-gray-100 hover:text-indigo-600">
                                Modérer les articles
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Groupe 2 : Commentaires -->
                    <div>
                        <h2 class="mb-2 text-xs font-bold tracking-wide text-gray-800 uppercase">Commentaires</h2>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('admin.comments.index') }}" class="block px-4 py-2 text-gray-700 transition rounded-lg hover:bg-gray-100 hover:text-indigo-600">
                                Modérer commentaires
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Groupe 3 : Profil -->
                    <div>
                        <h2 class="mb-2 text-xs font-bold tracking-wide text-gray-800 uppercase">Profil</h2>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 transition rounded-lg hover:bg-gray-100 hover:text-indigo-600">
                                Modifier mon profil
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </aside>

            <!-- Zone de contenu -->
            <main class="flex-1 p-4">
                @yield('content')
            </main>

        </div>

        <!-- Pied de page hérité de layouts/app.blade.php -->
        <footer class="bg-white shadow-md">
            <div class="flex flex-col items-center justify-between px-4 py-6 mx-auto space-y-4 text-center sm:flex-row sm:space-y-0 max-w-7xl">
                <div class="flex items-center space-x-2">
                    <img src="{{ asset('storage/articles/logo.png') }}" 
                         alt="Logo Footer" 
                         class="w-auto h-12 transition duration-500 ease-in-out hover:scale-110">
                    <span class="text-sm text-gray-600">&copy; {{ date('Y') }} {{ config('app.name') }}. Tous droits réservés.</span>
                </div>

                <div class="flex space-x-6">
                    <a href="{{ route('cgu') }}" class="text-sm text-gray-700 hover:text-blue-600">Conditions générales</a>
                    <a href="{{ route('confidentiality') }}" class="text-sm text-gray-700 hover:text-blue-600">Confidentialité</a>
                    <a href="{{ route('contact') }}" class="text-sm text-gray-700 hover:text-blue-600">Contact</a>
                    <a href="{{ route('about') }}" class="text-sm text-gray-700 hover:text-blue-600">À propos de moi</a>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts JS éventuels -->
    @vite('resources/js/app.js')
</body>
</html>
