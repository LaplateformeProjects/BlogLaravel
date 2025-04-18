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
                {{ __('Confirmer le mot de passe') }}
            </h2>

            <p class="mb-4 text-sm text-center text-gray-600">
                {{ __('Merci de confirmer votre mot de passe avant de continuer.') }}
            </p>

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div class="mb-4">
                    <x-input-label for="password" :value="__('Mot de passe')" />
                    <x-text-input id="password" class="w-full mt-1" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-500" />
                </div>

                <x-primary-button class="justify-center w-full">
                    {{ __('Confirmer') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-guest-layout>
