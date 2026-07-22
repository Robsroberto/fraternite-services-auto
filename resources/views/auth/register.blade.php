<x-guest-layout>
    <h1 class="mb-1 text-lg font-semibold text-gray-100">Créer un utilisateur</h1>
    <p class="mb-6 text-sm text-gray-500">Réservé aux administrateurs.</p>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" value="Nom complet" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="Adresse email" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="mt-4">
            <x-input-label for="role" value="Rôle" />
            <select id="role" name="role" class="w-full rounded-md border-gray-700 bg-gray-900 text-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="gestionnaire" @selected(old('role') == 'gestionnaire')>Gestionnaire</option>
                <option value="admin" @selected(old('role') == 'admin')>Administrateur</option>
            </select>
            <x-input-error :messages="$errors->get('role')" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Mot de passe" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirmer le mot de passe" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <a class="text-sm text-gray-400 hover:text-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 focus:ring-offset-gray-900" href="{{ route('dashboard') }}">
                Annuler
            </a>

            <x-primary-button class="ms-4">
                Créer l'utilisateur
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
