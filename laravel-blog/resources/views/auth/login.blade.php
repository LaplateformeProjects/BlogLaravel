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
                {{ __('Connexion') }}
            </h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                    <x-text-input id="email" class="w-full mt-1" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Mot de passe')" class="text-gray-700" />
                    <x-text-input id="password" class="w-full mt-1" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                </div>

                <!-- Remember Me + Forgot -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="flex items-center text-sm text-gray-600">
                        <input id="remember_me" type="checkbox" class="text-indigo-600 border-gray-300 rounded shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2">{{ __('Se souvenir de moi') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-sm text-indigo-600 hover:underline" href="{{ route('password.request') }}">
                            {{ __('Mot de passe oublié ?') }}
                        </a>
                    @endif
                </div>

                <!-- Submit -->
                <x-primary-button class="justify-center w-full">
                    {{ __('Se connecter') }}
                </x-primary-button>
            </form>

            <!-- Register Link -->
            <div class="text-sm text-center text-gray-600">
                {{ __("Pas encore de compte ?") }}
                <a href="{{ route('register') }}" class="font-medium text-indigo-600 hover:underline">
                    {{ __("Créer un compte") }}
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>
