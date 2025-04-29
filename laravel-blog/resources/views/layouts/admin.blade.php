<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Espace Admin - Mon Blog')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite('resources/css/app.css')
    <!-- Tu peux ajouter ici d'autres styles spécifiques si nécessaire -->
</head>
<body class="text-gray-900 bg-gray-100">
    <div class="flex flex-col min-h-screen">

        <!-- Navbar Admin (top bar) -->
        <header class="text-white bg-blue-600 shadow">
            <div class="flex items-center justify-between px-4 py-4 mx-auto max-w-7xl">
                <!-- Logo et titre -->
                <div class="flex items-center space-x-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" fill="none" viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M3 10l9-7 9 7v10a2 2 0 01-2 2h-4a2 2 0 01-2-2v-4H9v4a2 2 0 01-2 2H5a2 2 0 01-2-2V10z"/>
                    </svg>
                    <span class="text-2xl font-bold">Admin - Mon Blog</span>
                </div>
                <!-- Liens de navigation principaux -->
                <nav class="flex space-x-4">
                @auth
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-700">Bonjour, {{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-600 hover:underline">Déconnexion</button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Connexion</a>
                        <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Inscription</a>
                    </div>
                @endauth
                    <a href="{{ route('admin.articles.index') }}" class="hover:underline">Articles</a>
                    <a href="{{ route('admin.comments.index') }}" class="hover:underline">Commentaires</a>
                    {{-- Ajoute ici d’autres liens admin, par exemple pour les utilisateurs ou les statistiques --}}
                </nav>
                <!-- Lien de déconnexion (si nécessaire) -->
                <div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="hover:underline">Déconnexion</button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Contenu principal Admin -->
        <div class="flex flex-1">
            <!-- Sidebar (facultatif) : si tu veux une navigation latérale en plus de la top navbar -->
            <aside class="hidden w-64 p-4 bg-gray-200 md:block">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.articles.index') }}" class="block px-4 py-2 rounded hover:bg-gray-300">Gérer les articles</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.comments.index') }}" class="block px-4 py-2 rounded hover:bg-gray-300">Modérer les commentaires</a>
                    </li>
                    {{-- Tu peux ajouter d'autres éléments de menu ici --}}
                </ul>
            </aside>

            <!-- Zone de contenu -->
            <main class="flex-1 p-4">
                @yield('content')
            </main>
        </div>

        <!-- Pied de page -->
        <footer class="py-4 text-center text-white bg-blue-600">
            © {{ date('Y') }} - Admin - Mon Blog
        </footer>
    </div>

    <!-- Scripts JS éventuels -->
    @vite('resources/js/app.js')
</body>
</html>
