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
                {{ __('Réinitialiser le mot de passe') }}
            </h2>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="w-full mt-1" type="email" name="email" :value="old('email', $request->email)" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-500" />
                </div>

                <div class="mb-4">
                    <x-input-label for="password" :value="__('Mot de passe')" />
                    <x-text-input id="password" class="w-full mt-1" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                </div>

                <div class="mb-6">
                    <x-input-label for="password_confirmation" :value="__('Confirmer le mot de passe')" />
                    <x-text-input id="password_confirmation" class="w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-500" />
                </div>

                <x-primary-button class="justify-center w-full">
                    {{ __('Réinitialiser le mot de passe') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-guest-layout>
