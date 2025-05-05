@extends('layouts.app')

@section('content')
<div class="max-w-2xl p-8 mx-auto mt-2 bg-white rounded-lg shadow-md">
    <h1 class="mb-6 text-3xl font-bold text-center text-gray-800">Contactez-moi</h1>
    <p class="mb-6 text-center text-gray-800">Envoyez-moi un message pour toute question ou suggestion.</p>

    {{-- Message de succès --}}
    @if(session('success'))
        <div class="p-4 mb-6 text-green-700 bg-green-100 border border-green-400 rounded">
            {{ session('success') }}
        </div>
    @endif

    {{-- Message d'erreurs générales --}}
    @if ($errors->any())
        <div class="p-4 mb-6 text-red-700 bg-red-100 border border-red-400 rounded">
            <strong>Oups !</strong> Merci de corriger les erreurs ci-dessous.
        </div>
    @endif

    <div class="flex justify-center">
        <form action="{{ route('contact.send') }}" method="POST" class="w-full space-y-6">
            @csrf

            {{-- Nom --}}
            <div>
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700">Nom</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Téléphone --}}
            <div>
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-700">Téléphone</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                @error('phone')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required 
                       class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Message --}}
            <div>
                <label for="message" class="block mb-2 text-sm font-medium text-gray-700">Message</label>
                <textarea id="message" name="message" rows="5" required
                          class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">{{ old('message') }}</textarea>
                @error('message')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center">
                <button type="submit" 
                        class="px-6 py-2 mt-4 text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                    Envoyer
                </button>
            </div>
        </form>
    </div>
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
