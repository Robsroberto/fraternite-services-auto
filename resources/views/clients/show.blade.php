<x-app-layout>
    <x-slot name="header">Détail client</x-slot>

    <x-page-header :title="$client->nom_complet" subtitle="{{ $client->telephone }}{{ $client->email ? ' · '.$client->email : '' }}">
        <x-slot name="actions">
            <x-btn :href="route('clients.edit', $client)" variant="secondary" icon="pencil">Modifier</x-btn>
            <x-btn :href="route('clients.index')" variant="secondary">Retour</x-btn>
        </x-slot>
    </x-page-header>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="rounded-xl border border-gray-800 bg-gray-900 p-6">
            <h2 class="mb-4 text-sm font-semibold text-gray-200">Coordonnées</h2>
            <dl class="space-y-3 text-sm">
                <div><dt class="text-gray-500">Téléphone</dt><dd class="text-gray-200">{{ $client->telephone }}</dd></div>
                <div><dt class="text-gray-500">Email</dt><dd class="text-gray-200">{{ $client->email ?? '-' }}</dd></div>
                <div><dt class="text-gray-500">Adresse</dt><dd class="text-gray-200">{{ $client->adresse ?? '-' }}</dd></div>
                <div><dt class="text-gray-500">Pièce d'identité</dt><dd class="text-gray-200">{{ $client->numero_piece ?? '-' }}</dd></div>
            </dl>
            @if ($client->notes)
                <div class="mt-4 border-t border-gray-800 pt-4">
                    <dt class="mb-1 text-sm text-gray-500">Notes</dt>
                    <dd class="text-sm text-gray-300">{{ $client->notes }}</dd>
                </div>
            @endif
        </div>

        <div class="lg:col-span-2 space-y-6">
            <div class="rounded-xl border border-gray-800 bg-gray-900">
                <h2 class="border-b border-gray-800 px-5 py-4 text-sm font-semibold text-gray-200">Ventes</h2>
                <ul class="divide-y divide-gray-800">
                    @forelse ($client->ventes as $vente)
                        <li class="flex items-center justify-between px-5 py-3 text-sm">
                            <span class="text-gray-300">{{ $vente->vehicule->nom_complet }} &middot; {{ $vente->date_vente->format('d/m/Y') }}</span>
                            <div class="flex items-center gap-3">
                                <span class="text-gray-200 font-medium">{{ number_format($vente->prix_vente, 0, ',', ' ') }} FCFA</span>
                                <x-badge :statut="$vente->statut" />
                            </div>
                        </li>
                    @empty
                        <li class="px-5 py-6 text-center text-sm text-gray-500">Aucune vente pour ce client.</li>
                    @endforelse
                </ul>
            </div>

            <div class="rounded-xl border border-gray-800 bg-gray-900">
                <h2 class="border-b border-gray-800 px-5 py-4 text-sm font-semibold text-gray-200">Locations</h2>
                <ul class="divide-y divide-gray-800">
                    @forelse ($client->locations as $location)
                        <li class="flex items-center justify-between px-5 py-3 text-sm">
                            <span class="text-gray-300">{{ $location->vehicule->nom_complet }} &middot; {{ $location->date_debut->format('d/m/Y') }} - {{ $location->date_fin->format('d/m/Y') }}</span>
                            <div class="flex items-center gap-3">
                                <span class="text-gray-200 font-medium">{{ number_format($location->montant_total, 0, ',', ' ') }} FCFA</span>
                                <x-badge :statut="$location->statut" />
                            </div>
                        </li>
                    @empty
                        <li class="px-5 py-6 text-center text-sm text-gray-500">Aucune location pour ce client.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
