<x-guest-layout>
    <div class="flex items-center justify-center min-h-screen px-4 bg-gradient-to-br from-indigo-100 to-white">
        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-xl">

            <!-- Logo dynamique avec effet de couleur -->
            <div class="flex justify-center">
                <a href="/" class="transition-transform duration-300 hover:scale-110 group">
                    <img src="{{ asset('storage/articles/logo.png') }}" 
                        alt="Logo" 
                        class="w-auto h-16 transition duration-500 ease-in-out group-hover:filter group-hover:hue-rotate-15 group-hover:saturate-150 group-hover:brightness-110">
                </a>
            </div>

            <!-- Title -->
            <h2 class="text-2xl font-bold text-center text-indigo-700">
                {{ __('Créer un compte') }}
            </h2>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nom complet')" class="text-gray-700" />
                    <x-text-input id="name" class="w-full mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                    <x-text-input id="email" class="w-full mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Mot de passe')" class="text-gray-700" />
                    <x-text-input id="password" class="w-full mt-1" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" class="text-gray-700" />
                    <x-text-input id="password_confirmation" class="w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Submit -->
                <x-primary-button class="justify-center w-full">
                    {{ __('S’inscrire') }}
                </x-primary-button>
            </form>

            <!-- Login Link -->
            <div class="text-sm text-center text-gray-600">
                {{ __('Déjà inscrit ?') }}
                <a href="{{ route('login') }}" class="font-medium text-indigo-600 hover:underline">
                    {{ __('Se connecter') }}
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
