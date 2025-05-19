@extends('layouts.app')

@section('content')
<div class="max-w-2xl p-6 mx-auto bg-white rounded-lg shadow">
    <h1 class="mb-6 text-2xl font-semibold">Modifier mon profil</h1>

    @if(session('status') === 'profile-updated')
        <div class="p-4 mb-4 text-green-800 bg-green-100 rounded">
            Profil mis à jour avec succès.
        </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        {{-- Nom --}}
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                   class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                   class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('email')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Mot de passe (optionnel) --}}
        <div class="mb-4">
            <label for="password" class="block text-sm font-medium text-gray-700">Nouveau mot de passe</label>
            <input id="password" name="password" type="password"
                   class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            @error('password')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        {{-- Confirmation du mot de passe --}}
        <div class="mb-6">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                   class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div class="flex items-center justify-between">
            <button type="submit"
                    class="px-4 py-2 font-semibold text-white bg-indigo-500 rounded-lg hover:bg-indigo-800">
                Enregistrer les modifications
            </button>

            {{-- Formulaire de suppression de compte --}}
            <form method="POST" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.')">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="text-sm text-red-600 hover:underline">
                    Supprimer mon compte
                </button>
            </form>
        </div>
    </form>
</div>
@endsection
