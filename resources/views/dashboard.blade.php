<x-app-layout>
    <x-slot name="header">Tableau de bord</x-slot>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        <x-stat-card label="Véhicules disponibles" :value="$stats['vehicules_disponibles']" icon="car" accent="emerald" />
        <x-stat-card label="Véhicules loués" :value="$stats['vehicules_loues']" icon="calendar" accent="sky" />
        <x-stat-card label="Chiffre d'affaires ventes" :value="number_format($stats['ca_ventes'], 0, ',', ' ').' FCFA'" icon="cash" accent="indigo" />
        <x-stat-card label="Chiffre d'affaires locations" :value="number_format($stats['ca_locations'], 0, ',', ' ').' FCFA'" icon="cash" accent="amber" />
    </div>

    <div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="rounded-xl border border-gray-800 bg-gray-900">
            <div class="flex items-center justify-between border-b border-gray-800 px-5 py-4">
                <h2 class="text-sm font-semibold text-gray-200">Dernières ventes</h2>
                <a href="{{ route('ventes.index') }}" class="text-xs font-medium text-indigo-400 hover:text-indigo-300">Voir tout</a>
            </div>
            <ul class="divide-y divide-gray-800">
                @forelse ($dernieresVentes as $vente)
                    <li class="flex items-center justify-between px-5 py-3">
                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-gray-200">{{ $vente->vehicule->nom_complet }}</p>
                            <p class="text-xs text-gray-500">{{ $vente->client->nom_complet }} &middot; {{ $vente->date_vente->format('d/m/Y') }}</p>
                        </div>
                        <div class="flex items-center gap-3 shrink-0">
                            <span class="text-sm font-semibold text-gray-200">{{ number_format($vente->prix_vente, 0, ',', ' ') }} FCFA</span>
                            <x-badge :statut="$vente->statut" />
                        </div>
                    </li>
                @empty
                    <li class="px-5 py-8 text-center text-sm text-gray-500">Aucune vente enregistrée pour l'instant.</li>
                @endforelse
            </ul>
        </div>

        <div class="rounded-xl border border-gray-800 bg-gray-900">
            <div class="flex items-center justify-between border-b border-gray-800 px-5 py-4">
                <h2 class="text-sm font-semibold text-gray-200">Dernières locations</h2>
                <a href="{{ route('locations.index') }}" class="text-xs font-medium text-indigo-400 hover:text-indigo-300">Voir tout</a>
            </div>
            <ul class="divide-y divide-gray-800">
                @forelse ($dernieresLocations as $location)
                    <li class="flex items-center justify-between px-5 py-3">
                        <div class="min-w-0">
                            <p class="truncate text-sm font-medium text-gray-200">{{ $location->vehicule->nom_complet }}</p>
                            <p class="text-xs text-gray-500">{{ $location->client->nom_complet }} &middot; {{ $location->date_debut->format('d/m/Y') }} - {{ $location->date_fin->format('d/m/Y') }}</p>
                        </div>
                        <div class="flex items-center gap-3 shrink-0">
                            <span class="text-sm font-semibold text-gray-200">{{ number_format($location->montant_total, 0, ',', ' ') }} FCFA</span>
                            <x-badge :statut="$location->statut" />
                        </div>
                    </li>
                @empty
                    <li class="px-5 py-8 text-center text-sm text-gray-500">Aucune location enregistrée pour l'instant.</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-app-layout>
