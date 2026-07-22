<x-app-layout>
    <x-slot name="header">Détail du véhicule</x-slot>

    <x-page-header :title="$vehicule->marque.' '.$vehicule->modele" subtitle="Immatriculation {{ $vehicule->immatriculation }}">
        <x-slot name="actions">
            <x-btn :href="route('vehicules.edit', $vehicule)" variant="secondary" icon="pencil">Modifier</x-btn>
            <x-btn :href="route('vehicules.index')" variant="secondary">Retour</x-btn>
        </x-slot>
    </x-page-header>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="lg:col-span-2 rounded-xl border border-gray-800 bg-gray-900 p-6">
            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-sm font-semibold text-gray-200">Informations générales</h2>
                <x-badge :statut="$vehicule->statut" />
            </div>
            <dl class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm sm:grid-cols-3">
                <div><dt class="text-gray-500">Année</dt><dd class="text-gray-200">{{ $vehicule->annee }}</dd></div>
                <div><dt class="text-gray-500">Couleur</dt><dd class="text-gray-200">{{ $vehicule->couleur ?? '-' }}</dd></div>
                <div><dt class="text-gray-500">Kilométrage</dt><dd class="text-gray-200">{{ number_format($vehicule->kilometrage, 0, ',', ' ') }} km</dd></div>
                <div><dt class="text-gray-500">Carburant</dt><dd class="text-gray-200">{{ ucfirst($vehicule->carburant) }}</dd></div>
                <div><dt class="text-gray-500">Transmission</dt><dd class="text-gray-200">{{ ucfirst($vehicule->transmission) }}</dd></div>
                <div><dt class="text-gray-500">Offre</dt><dd class="text-gray-200">{{ ucfirst(str_replace('_', ' / ', $vehicule->type_offre)) }}</dd></div>
                @if ($vehicule->prix_vente)
                    <div><dt class="text-gray-500">Prix de vente</dt><dd class="text-gray-200">{{ number_format($vehicule->prix_vente, 0, ',', ' ') }} FCFA</dd></div>
                @endif
                @if ($vehicule->prix_location_jour)
                    <div><dt class="text-gray-500">Prix / jour</dt><dd class="text-gray-200">{{ number_format($vehicule->prix_location_jour, 0, ',', ' ') }} FCFA</dd></div>
                @endif
            </dl>
            @if ($vehicule->description)
                <div class="mt-5 border-t border-gray-800 pt-4">
                    <dt class="mb-1 text-sm text-gray-500">Description</dt>
                    <dd class="text-sm text-gray-300">{{ $vehicule->description }}</dd>
                </div>
            @endif
        </div>

        <div class="rounded-xl border border-gray-800 bg-gray-900 p-6">
            <h2 class="mb-4 text-sm font-semibold text-gray-200">Actions rapides</h2>
            <div class="flex flex-col gap-2">
                <x-btn :href="route('ventes.create', ['vehicule_id' => $vehicule->id])" icon="cash" class="justify-center">Enregistrer une vente</x-btn>
                <x-btn :href="route('locations.create', ['vehicule_id' => $vehicule->id])" variant="secondary" icon="calendar" class="justify-center">Créer une location</x-btn>
            </div>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="rounded-xl border border-gray-800 bg-gray-900">
            <h2 class="border-b border-gray-800 px-5 py-4 text-sm font-semibold text-gray-200">Historique des ventes</h2>
            <ul class="divide-y divide-gray-800">
                @forelse ($vehicule->ventes as $vente)
                    <li class="flex items-center justify-between px-5 py-3 text-sm">
                        <span class="text-gray-300">{{ $vente->client->nom_complet }} &middot; {{ $vente->date_vente->format('d/m/Y') }}</span>
                        <x-badge :statut="$vente->statut" />
                    </li>
                @empty
                    <li class="px-5 py-6 text-center text-sm text-gray-500">Aucune vente pour ce véhicule.</li>
                @endforelse
            </ul>
        </div>
        <div class="rounded-xl border border-gray-800 bg-gray-900">
            <h2 class="border-b border-gray-800 px-5 py-4 text-sm font-semibold text-gray-200">Historique des locations</h2>
            <ul class="divide-y divide-gray-800">
                @forelse ($vehicule->locations as $location)
                    <li class="flex items-center justify-between px-5 py-3 text-sm">
                        <span class="text-gray-300">{{ $location->client->nom_complet }} &middot; {{ $location->date_debut->format('d/m/Y') }} - {{ $location->date_fin->format('d/m/Y') }}</span>
                        <x-badge :statut="$location->statut" />
                    </li>
                @empty
                    <li class="px-5 py-6 text-center text-sm text-gray-500">Aucune location pour ce véhicule.</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-app-layout>
