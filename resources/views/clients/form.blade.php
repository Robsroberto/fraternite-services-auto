@php $editing = $client->exists; @endphp
<x-app-layout>
    <x-slot name="header">{{ $editing ? 'Modifier un client' : 'Ajouter un client' }}</x-slot>

    <x-page-header :title="$editing ? $client->nom_complet : 'Nouveau client'">
        <x-slot name="actions">
            <x-btn :href="route('clients.index')" variant="secondary">Annuler</x-btn>
        </x-slot>
    </x-page-header>

    <form method="POST" action="{{ $editing ? route('clients.update', $client) : route('clients.store') }}" class="max-w-2xl rounded-xl border border-gray-800 bg-gray-900 p-6">
        @csrf
        @if ($editing) @method('PUT') @endif

        <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
            <div>
                <x-input-label for="prenom" value="Prénom" />
                <x-text-input id="prenom" name="prenom" value="{{ old('prenom', $client->prenom) }}" required autofocus />
                <x-input-error :messages="$errors->get('prenom')" />
            </div>
            <div>
                <x-input-label for="nom" value="Nom" />
                <x-text-input id="nom" name="nom" value="{{ old('nom', $client->nom) }}" required />
                <x-input-error :messages="$errors->get('nom')" />
            </div>
            <div>
                <x-input-label for="telephone" value="Téléphone" />
                <x-text-input id="telephone" name="telephone" value="{{ old('telephone', $client->telephone) }}" required />
                <x-input-error :messages="$errors->get('telephone')" />
            </div>
            <div>
                <x-input-label for="email" value="Email" />
                <x-text-input id="email" type="email" name="email" value="{{ old('email', $client->email) }}" />
                <x-input-error :messages="$errors->get('email')" />
            </div>
            <div>
                <x-input-label for="numero_piece" value="N° CNI / Passeport" />
                <x-text-input id="numero_piece" name="numero_piece" value="{{ old('numero_piece', $client->numero_piece) }}" />
                <x-input-error :messages="$errors->get('numero_piece')" />
            </div>
            <div>
                <x-input-label for="adresse" value="Adresse" />
                <x-text-input id="adresse" name="adresse" value="{{ old('adresse', $client->adresse) }}" />
                <x-input-error :messages="$errors->get('adresse')" />
            </div>
            <div class="sm:col-span-2">
                <x-input-label for="notes" value="Notes" />
                <textarea id="notes" name="notes" rows="3" class="w-full rounded-md border-gray-700 bg-gray-900 text-gray-200 text-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes', $client->notes) }}</textarea>
                <x-input-error :messages="$errors->get('notes')" />
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-3 border-t border-gray-800 pt-5">
            <x-btn :href="route('clients.index')" variant="secondary">Annuler</x-btn>
            <x-btn type="submit">{{ $editing ? 'Enregistrer les modifications' : 'Ajouter le client' }}</x-btn>
        </div>
    </form>
</x-app-layout>
