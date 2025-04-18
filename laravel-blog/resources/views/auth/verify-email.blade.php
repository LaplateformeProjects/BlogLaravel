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
            
            <h2 class="mb-4 text-xl font-semibold text-center text-indigo-700">
                {{ __('Vérifiez votre email') }}
            </h2>

            <p class="mb-4 text-sm text-center text-gray-600">
                {{ __('Merci pour votre inscription ! Veuillez cliquer sur le lien dans l’e-mail que nous venons de vous envoyer. Si vous ne l’avez pas reçu, nous vous en renverrons un.') }}
            </p>

            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-sm font-medium text-center text-green-600">
                    {{ __('Un nouveau lien de vérification a été envoyé.') }}
                </div>
            @endif

            <div class="flex flex-col space-y-4">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <x-primary-button class="justify-center w-full">
                        {{ __('Renvoyer l’e-mail de vérification') }}
                    </x-primary-button>
                </form>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-sm text-center text-gray-600 underline hover:text-gray-900">
                        {{ __('Se déconnecter') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
