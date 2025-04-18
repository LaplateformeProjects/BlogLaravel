<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen px-4 bg-gradient-to-br from-indigo-100 to-white">
        <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-xl">

            <!-- Logo dynamique avec effet de couleur -->
            <div class="flex justify-center">
                <a href="/" class="transition-transform duration-300 hover:scale-110 group">
                    <img src="{{ asset('storage/articles/logo.png') }}" 
                        alt="Logo" 
                        class="w-auto h-16 transition duration-500 ease-in-out group-hover:filter group-hover:hue-rotate-15 group-hover:saturate-150 group-hover:brightness-110">
                </a>
            </div>
            
            <h2 class="mb-6 text-xl font-semibold text-center text-indigo-700">
                {{ __('Mot de passe oublié ?') }}
            </h2>

            <p class="mb-4 text-sm text-center text-gray-600">
                {{ __('Pas de souci ! Indiquez votre adresse e-mail et nous vous enverrons un lien pour réinitialiser votre mot de passe.') }}
            </p>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="w-full mt-1" type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                </div>

                <x-primary-button class="justify-center w-full">
                    {{ __('Envoyer le lien de réinitialisation') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-guest-layout>
