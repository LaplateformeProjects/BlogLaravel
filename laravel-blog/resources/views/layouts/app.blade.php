<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
    <nav class="bg-white shadow-md">
    <div class="flex items-center justify-between px-4 py-3 mx-auto max-w-7xl">
        <a href="/" class="transition-transform duration-300 hover:scale-110 group">
            <img src="{{ asset('storage/articles/logo.png') }}" 
                alt="Logo" 
                class="w-auto h-16 transition duration-500 ease-in-out group-hover:filter group-hover:hue-rotate-15 group-hover:saturate-150 group-hover:brightness-110">
        </a>

        <!-- Menu burger -->
        <div class="sm:hidden">
            <button @click="open = !open" class="text-gray-600 focus:outline-none" x-data="{ open: false }">
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
                    <a href="{{ route('admin.articles.index') }}" class="text-green-500 hover:text-green-800 hover:underline">Retour Dashboard</a>
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
    <div class="px-4 pt-2 pb-4 space-y-2 sm:hidden" x-show="open" x-data="{ open: false }" style="display: none;">
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

        <div class="min-h-screen bg-gray-200">
           {{-- @include('layouts.navigation') --}}

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main class="px-4 py-10">
                @yield('content')
            </main>

        </div>
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

    </body>
</html>