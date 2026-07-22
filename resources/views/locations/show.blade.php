<x-app-layout>
    <x-slot name="header">Détail de la location</x-slot>

    <x-page-header title="Location #{{ $location->id }}" subtitle="{{ $location->vehicule->nom_complet }}">
        <x-slot name="actions">
            <x-btn :href="route('locations.edit', $location)" variant="secondary" icon="pencil">Modifier</x-btn>
            <x-btn :href="route('locations.index')" variant="secondary">Retour</x-btn>
        </x-slot>
    </x-page-header>

    <div class="max-w-2xl rounded-xl border border-gray-800 bg-gray-900 p-6">
        <div class="mb-4 flex items-center justify-between">
            <h2 class="text-sm font-semibold text-gray-200">Informations</h2>
            <x-badge :statut="$location->statut" />
        </div>
        <dl class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm">
            <div><dt class="text-gray-500">Véhicule</dt><dd class="text-gray-200"><a href="{{ route('vehicules.show', $location->vehicule) }}" class="text-indigo-400 hover:underline">{{ $location->vehicule->nom_complet }}</a></dd></div>
            <div><dt class="text-gray-500">Client</dt><dd class="text-gray-200"><a href="{{ route('clients.show', $location->client) }}" class="text-indigo-400 hover:underline">{{ $location->client->nom_complet }}</a></dd></div>
            <div><dt class="text-gray-500">Période</dt><dd class="text-gray-200">{{ $location->date_debut->format('d/m/Y') }} - {{ $location->date_fin->format('d/m/Y') }} ({{ $location->duree_jours }} jours)</dd></div>
            <div><dt class="text-gray-500">Prix / jour</dt><dd class="text-gray-200">{{ number_format($location->prix_jour, 0, ',', ' ') }} FCFA</dd></div>
            <div><dt class="text-gray-500">Caution</dt><dd class="text-gray-200">{{ number_format($location->caution, 0, ',', ' ') }} FCFA</dd></div>
            <div><dt class="text-gray-500">Montant total</dt><dd class="text-gray-200 font-semibold">{{ number_format($location->montant_total, 0, ',', ' ') }} FCFA</dd></div>
            <div><dt class="text-gray-500">Enregistrée par</dt><dd class="text-gray-200">{{ $location->user->name }}</dd></div>
        </dl>
        @if ($location->notes)
            <div class="mt-5 border-t border-gray-800 pt-4">
                <dt class="mb-1 text-sm text-gray-500">Notes</dt>
                <dd class="text-sm text-gray-300">{{ $location->notes }}</dd>
            </div>
        @endif
    </div>
</x-app-layout>
